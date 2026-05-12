# 🧩 Sistema de Gestión - CodeIgniter 4

Sistema web desarrollado en PHP utilizando CodeIgniter 4 como parte de la materia **Taller de Programación I**.

El sistema permite la gestión de usuarios, productos y ventas mediante una interfaz web dinámica conectada a una base de datos MySQL.

---

## 🚀 Funcionalidades

- Gestión de usuarios (CRUD)
- Gestión de productos
- Registro y control de ventas
- Sistema de autenticación
- Interfaz web dinámica

---

## 👥 Roles del sistema

### 🔹 Visitante
- Acceso a información pública del sistema

### 🔹 Cliente
- Registro e inicio de sesión
- Interacción con el sistema

### 🔹 Administrador
- Gestión completa del sistema (CRUD)
- Administración de usuarios, productos y ventas

---

## 🛠️ Tecnologías utilizadas

- PHP
- CodeIgniter 4
- MySQL
- HTML
- CSS
- JavaScript
- XAMPP

---

## ⚙️ Instalación del proyecto

1. Clonar el repositorio  
   git clone https://github.com/prisrodriguezz/sistema-gestion-tiendamate.git

2. Instalar dependencias  
   composer install

3. Configurar entorno  
   - Copiar `.env.example` y renombrar a `.env`  
   - Configurar los datos de base de datos (XAMPP / MySQL)

4. Importar base de datos  
   - Importar el archivo `/database/bd_rodriguez_priscila.sql`

5. Ejecutar el proyecto  
   php spark serve

## 🔐 Acceso al sistema

El sistema cuenta con un usuario administrador para pruebas:

- Usuario: admin  
- Contraseña: admin  

También se pueden crear usuarios desde el registro (rol cliente).

---

## 📁 Estructura del proyecto

app/         → Lógica del sistema (MVC)  
public/      → Punto de entrada del sistema  
writable/    → Archivos temporales  
database/    → Script de base de datos  
docs/        → Documentación (ERS)

---

## 👩‍💻 Autora

Priscila Rodríguez  
Estudiante de Licenciatura en Sistemas de la Información

---

## ⭐ Nota
Este proyecto fue desarrollado con fines académicos, aplicando buenas prácticas de desarrollo.
