Tu README es bastante completo, pero hay algunos detalles que podrían mejorar la claridad, la gramática y la estructura. Aquí tienes una versión revisada con algunos ajustes:

---

# Bienes Raíces Inicio

Este es un proyecto de práctica en PHP utilizando Programación Orientada a Objetos (POO) con el patrón de arquitectura MVC. La aplicación web permite gestionar propiedades inmobiliarias de manera eficiente.

## Descripción

La aplicación está diseñada para que los usuarios puedan:
- Gestionar propiedades y vendedores.
- Enviar mensajes de contacto.

Se utilizan las siguientes herramientas y tecnologías:
- **Composer**: Para la gestión de dependencias de PHP.
- **Gulp**: Para compilar archivos SCSS y JavaScript.

## Requisitos

- **PHP** >= 8.1
- **Composer**
- **Node.js** y **npm**
- **MySQL** (o un gestor de base de datos compatible)

## Instalación

Sigue estos pasos para configurar el proyecto:

1. **Clona el repositorio**:
    ```sh
    git clone https://github.com/jorgesanchez99/bienesraices_mvc.git
    cd bienesraices_mvc
    ```

2. **Instala las dependencias de PHP con Composer**:
    ```sh
    composer install
    ```

3. **Instala las dependencias de Node.js con npm**:
    ```sh
    npm install
    ```

4. **Compila los archivos SCSS y JavaScript**:
    ```sh
    npm run dev
    ```

## Uso

1. **Configura la base de datos**: Asegúrate de que el archivo de conexión está correctamente configurado (ver sección "Configuración de la conexión").
2. **Inicia el servidor PHP**:
    ```sh
    php -S localhost:3000
    ```
3. **Accede a la aplicación**: Abre tu navegador y dirígete a `http://localhost:3000`.

## Base de Datos

El proyecto utiliza una base de datos MySQL para gestionar propiedades, vendedores y usuarios.

### Configuración inicial

Puedes importar la estructura y los datos iniciales utilizando el archivo SQL incluido en el repositorio. 

**Nota:** Para iniciar sesión, usa las siguientes credenciales por defecto:
- **Usuario**: `correo@correo.com`
- **Clave**: `123456`

### Nombre de la base de datos

- **Nombre sugerido:** `bienesraices_crud`

### Tablas necesarias

El esquema de la base de datos incluye las siguientes tablas:
- `propiedades`
- `usuarios`
- `vendedores`

### Configuración de la conexión

Edita el archivo de conexión ubicado en `includes/config/database.php` para agregar tus credenciales de acceso a la base de datos:
```php
function conectarBD(): mysqli {
    $db = new mysqli('localhost', 'usuario', 'contraseña', 'nombre_base');
    if ($db->connect_error) {
        echo "Error: No se pudo conectar a la base de datos.";
        exit;
    }
    return $db;
}
```

## Autor

- **Jorge Anthony Sánchez Chávez**  
  [jorgesanchez99dev@gmail.com](mailto:jorgesanchez99dev@gmail.com)

