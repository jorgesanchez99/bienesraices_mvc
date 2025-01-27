import path from 'path';
import fs from 'fs';
import { glob } from 'glob';
import { src, dest, watch, series } from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';
import terser from 'gulp-terser';
import sharp from 'sharp';
import svgmin from 'gulp-svgmin'; // Agregar plugin para optimizar SVG

const sass = gulpSass(dartSass);

// Rutas
const paths = {
  scss: './src/scss/**/*.scss',
  js: './src/js/**/*.js',
  images: './src/img/**/*.{jpg,png,svg}', // Incluir SVG en las rutas
  imgDir: './src/img',
  buildDir: './public/build/img',
};

// Procesar CSS con Sass y PostCSS
export function css(done) {
  src(paths.scss, { sourcemaps: true })
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(dest('./public/build/css', { sourcemaps: '.' }));
  done();
}

// Procesar JavaScript
export function javascript(done) {
  src(paths.js, { sourcemaps: true })
    .pipe(terser())
    .pipe(dest('./public/build/js', { sourcemaps: '.' }));
  done();
}

// Procesar imágenes con `sharp` para formatos rasterizados (JPG, PNG)
export async function processImages(done) {
  const images = await glob(paths.images);
  images.forEach((file) => {
    const relativePath = path.relative(paths.imgDir, path.dirname(file));
    const outputDir = path.join(paths.buildDir, relativePath);
    processImage(file, outputDir);
  });
  done();
}

function processImage(file, outputDir) {
  if (!fs.existsSync(outputDir)) {
    fs.mkdirSync(outputDir, { recursive: true });
  }

  const extName = path.extname(file);
  if (extName === '.svg') {
    // // Para SVG, usamos gulp-svgmin
    // // const outputFile = path.join(outputDir, path.basename(file));
    // src(file)
    //   .pipe(svgmin()) // Optimización de SVG
    //   .pipe(dest(outputDir));
    //* Copiar SVG tal cual, sin optimizar
    const outputFile = path.join(outputDir, path.basename(file));
    fs.copyFileSync(file, outputFile);
  } else {
    // Para JPG/PNG, usamos sharp
    const baseName = path.basename(file, extName);
    const outputFile = path.join(outputDir, `${baseName}${extName}`);
    const outputWebp = path.join(outputDir, `${baseName}.webp`);
    const outputAvif = path.join(outputDir, `${baseName}.avif`);
    const options = { quality: 80 };

    sharp(file).jpeg(options).toFile(outputFile);
    sharp(file).webp(options).toFile(outputWebp);
    sharp(file).avif().toFile(outputAvif);
  }
}

// Recortar imágenes (opcional)
export async function cropImages(done) {
  const inputFolder = './src/img/gallery/full';
  const outputFolder = './src/img/gallery/thumb';
  const width = 250;
  const height = 180;

  if (!fs.existsSync(outputFolder)) {
    fs.mkdirSync(outputFolder, { recursive: true });
  }

  const images = fs
    .readdirSync(inputFolder)
    .filter((file) => /\.(jpg|png)$/i.test(file));

  try {
    images.forEach((file) => {
      const inputFile = path.join(inputFolder, file);
      const outputFile = path.join(outputFolder, file);
      sharp(inputFile).resize(width, height).toFile(outputFile);
    });
    done();
  } catch (error) {
    console.error(error);
  }
}

// Tarea para vigilar cambios
export function watchFiles() {
  watch(paths.scss, css);
  watch(paths.js, javascript);
  watch(paths.images, processImages);
}

// Tarea por defecto
export default series(javascript,css, processImages, watchFiles);
