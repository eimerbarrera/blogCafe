# Café Cosecha y Grano (`cosechaygrano.com`)

Plataforma editorial y blog especializado en cultura cafetera, métodos de preparación, tueste y origen del café, desarrollado con **Laravel 13.35.0** y **PHP 8.4**.

## Descripción del Proyecto

**Café Cosecha y Grano** combina una experiencia de lectura moderna (basada en el sistema visual **NoonPost** con soporte adaptativo para modo claro y oscuro) y un panel administrativo completo para la gestión editorial, control de roles y trazabilidad de contenidos.

## Tecnologías Principales

- **Backend:** Laravel 13.35.0 (PHP 8.4.3)
- **Base de datos:** MySQL
- **Frontend:** Blade Templates, Bootstrap / NoonPost UI (Modo Claro / Oscuro), CSS personalizado
- **Infraestructura:** Hostinger (Document Root apuntando a `/public`, SMTP corporativo y enlace simbólico en `public/storage`)

## Funcionalidades Implementadas

- **Gestión de Artículos (Posts):** Creación, edición, publicación, eliminación lógica (*Soft Deletes*), soporte de múltiples categorías por artículo y etiquetas (*tags*).
- **Categorías y Etiquetas:** Clasificación dinámica de contenidos con trazabilidad de autor/creador (`user_id`).
- **Control de Usuarios y Roles:** Registro, autenticación, seguimiento de último inicio de sesión (*last login*), gestión de permisos y notificaciones por correo electrónico mediante SMTP.
- **Identidad Visual y Experiencia de Usuario:** Pantalla de carga personalizada con el isotipo `favicon_CyG.png`, diseño responsivo y localización completa al español (`es`).

## Instalación en Entorno Local

1. Clonar el repositorio e ingresar al directorio del proyecto:
   ```bash
   git clone <url-de-tu-repositorio>
   cd blogCafe
