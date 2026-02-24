# Sistema de Gestión de Consultorio Médico

Desarrollado por:
Franco Martín Schimizzi

Este proyecto fue desarrollado como parte del Segundo Parcial de Producción Web.  
El sistema permite la gestión de pacientes y turnos dentro de un consultorio, implementando autenticación de usuarios con Laravel Breeze.

> **Nota importante:** Este proyecto fue preparado para la entrega sin dependencias ni archivos generados (como `vendor`, `node_modules`, `.env`, etc.).  
> Para que funcione correctamente, ejecute los pasos detallados en "Instalación y ejecución" comenzando por `composer install` y `npm install`.

---

## Tecnologías utilizadas

- PHP 8.x
- Laravel 11
- Laravel Breeze (autenticación)
- MySQL
- XAMPP
- PhpStorm (JetBrains)

---

## Funcionalidades implementadas

### Pacientes
- Crear, ver, editar y eliminar pacientes.
- Campos: nombre, DNI, email, teléfono, fecha de nacimiento.
- Validación de datos en formularios.
- **Asociación con el usuario logueado**: cada paciente está asociado al usuario que lo creó.

### Turnos
- Agendar, editar, listar y cancelar turnos.
- Relación con el paciente (por DNI).
- Estado del turno: Pendiente, Confirmado, Cancelado.
- Validación de fecha y existencia del paciente.
- **Asociación con el usuario logueado**: cada turno está asociado al usuario que lo creó.

### Autenticación
- Registro e inicio de sesión de usuarios.
- Redirección segura al panel de control (`/dashboard`).
- Acceso protegido a rutas mediante middleware `auth`.
- **Filtrado de datos**: cada usuario solo puede ver y editar sus propios pacientes y turnos.

---

## Estructura de carpetas destacada

app/  
├── Models/ Paciente.php, Turno.php, User.php  
├── Http/Controllers/ PacienteController.php, TurnoController.php

resources/  
├── views/  
│ ├── pacientes/ index.blade.php, create.blade.php, edit.blade.php  
│ ├── turnos/ index.blade.php, create.blade.php, edit.blade.php  
│ └── dashboard.blade.php

routes/  
├── web.php  
├── auth.php

database/  
├── migrations/  
├── bd.sql *(opcional para importar la base de datos manualmente)*

.env.public → Archivo de entorno sin claves sensibles

---

## Requisitos previos

- Tener XAMPP instalado y corriendo (Apache + MySQL)
- Crear una base de datos llamada: `consultorio`
- Tener PHP y Composer configurados en el sistema
- Tener Node.js y NPM instalados

---

## Instalación y ejecución

1. Clonar o copiar el proyecto dentro de la carpeta `htdocs`:


2. Renombrar `.env.public` a `.env`:

cp .env.public .env

3. Instalar dependencias:
composer install
npm install
npm run dev

4. Generar la clave de la aplicación:
php artisan key:generate

5. Ejecutar migraciones para crear las tablas:
php artisan migrate

6. Iniciar el servidor de desarrollo:
php artisan serve

7. Acceder a la app:
http://127.0.0.1:8000

Registrarse desde /register

Luego de iniciar sesión, el usuario accede al Dashboard

Desde allí puede acceder a Pacientes y Turnos, con formularios y operaciones CRUD completas

Podés cargar pacientes y turnos desde el sistema.
Cada usuario solo accede a sus propios registros.
Los datos se almacenan automáticamente en la base consultorio (MySQL).
Se eliminaron las carpetas: vendor/, node_modules/, storage/, config/, tests/ para cumplir con la consigna.

El archivo .env fue reemplazado por .env.public, que debe ser renombrado antes de ejecutar el sistema.

Las dependencias se regeneran con composer install y npm install.