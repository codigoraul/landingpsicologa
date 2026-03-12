# 📦 Documentación de Respaldo y Entrega - Landing Psicóloga

**Proyecto:** Landing Page Camila Kush de la Puente - Psicóloga Clínica  
**Dominio:** https://ckdelap.cl  
**Fecha:** Marzo 2026  
**Desarrollador:** Código Raúl

---

## 🗂️ RESPALDO DEL REPOSITORIO GITHUB

### Información del Repositorio
- **URL:** https://github.com/codigoraul/landingpsicologa
- **Rama principal:** `main`
- **Último commit:** Ver historial en GitHub

### Cómo Hacer el Respaldo

#### Opción 1: Clonar el Repositorio Completo
```bash
# Clonar con todo el historial
git clone https://github.com/codigoraul/landingpsicologa.git
cd landingpsicologa

# Crear archivo comprimido
tar -czf landingpsicologa-backup-$(date +%Y%m%d).tar.gz landingpsicologa/
```

#### Opción 2: Descargar desde GitHub
1. Ir a https://github.com/codigoraul/landingpsicologa
2. Click en "Code" → "Download ZIP"
3. Guardar como: `landingpsicologa-backup-YYYYMMDD.zip`

#### Opción 3: Exportar Release
```bash
# Crear un release tag
git tag -a v1.0.0 -m "Versión de entrega - Marzo 2026"
git push origin v1.0.0

# Descargar desde GitHub Releases
```

---

## 🌐 RESPALDO WORDPRESS HEADLESS

### Información del WordPress
- **URL Admin:** https://ckdelap.cl/admin
- **API REST:** https://ckdelap.cl/admin/wp-json/wp/v2
- **Versión:** WordPress Headless (sin tema frontend)

### Contenido a Respaldar

#### 1. Base de Datos MySQL
```bash
# Exportar base de datos completa
mysqldump -u usuario -p nombre_base_datos > wordpress-db-backup-$(date +%Y%m%d).sql

# O usar phpMyAdmin:
# 1. Acceder a phpMyAdmin
# 2. Seleccionar base de datos
# 3. Exportar → Método: Rápido → Formato: SQL
# 4. Guardar como: wordpress-db-backup-YYYYMMDD.sql
```

#### 2. Archivos de WordPress
```bash
# Comprimir carpeta completa de WordPress
cd /ruta/al/servidor
tar -czf wordpress-files-backup-$(date +%Y%m%d).tar.gz admin/

# Incluye:
# - wp-content/plugins/
# - wp-content/themes/
# - wp-content/uploads/
# - wp-config.php (¡IMPORTANTE!)
```

#### 3. Contenido Crítico a Respaldar

**Plugins Instalados:**
- Advanced Custom Fields (ACF)
- Custom Post Type UI
- WP REST API
- Otros plugins activos

**Custom Post Types:**
- Servicios
- Testimonios
- Otros CPT personalizados

**Configuración ACF:**
- Exportar grupos de campos desde ACF
- Guardar JSON en: `acf-json-backup/`

---

## 📋 ARCHIVOS IMPORTANTES DEL PROYECTO

### Estructura del Proyecto Astro
```
psicologa landing/
├── public/
│   ├── contacto.php          # Formulario de contacto
│   ├── contacto-config.php   # Configuración emails
│   ├── robots.txt            # SEO
│   ├── sitemap.xml           # SEO
│   └── images/               # Imágenes estáticas
├── src/
│   ├── components/           # Componentes Astro
│   ├── layouts/              # Layouts
│   └── pages/                # Páginas
├── package.json              # Dependencias
└── astro.config.mjs          # Configuración Astro
```

### Archivos de Configuración Críticos
- `package.json` - Dependencias del proyecto
- `astro.config.mjs` - Configuración de Astro
- `public/contacto-config.php` - Emails de contacto
- `.env` (si existe) - Variables de entorno

---

## 🔑 CREDENCIALES Y CONFIGURACIÓN

### Variables de Entorno Importantes
```env
# WordPress API
WORDPRESS_API_URL=https://ckdelap.cl/admin/wp-json/wp/v2

# Configuración del sitio
SITE_URL=https://ckdelap.cl
BASE_PATH=/prueba  # Cambiar a '' en producción

# Emails
CONTACT_TO_EMAIL=codigoraul@gmail.com, contacto@ckdelap.cl
CONTACT_FROM_EMAIL=formulario@ckdelap.cl
CONTACT_FROM_NAME=Camila Kush de la Puente - Psicóloga
```

### Configuración de Hosting
- **Servidor:** [Nombre del hosting]
- **Panel de control:** [URL del cPanel/Plesk]
- **FTP/SFTP:** [Credenciales - guardar de forma segura]
- **Base de datos:** [Credenciales - guardar de forma segura]

---

## 🚀 INSTRUCCIONES DE RESTAURACIÓN

### Restaurar Repositorio GitHub
```bash
# 1. Descomprimir backup
tar -xzf landingpsicologa-backup-YYYYMMDD.tar.gz
cd landingpsicologa

# 2. Instalar dependencias
npm install

# 3. Configurar variables de entorno
cp .env.example .env
# Editar .env con las credenciales correctas

# 4. Build del proyecto
npm run build

# 5. Deploy
# Subir carpeta dist/ al servidor
```

### Restaurar WordPress
```bash
# 1. Restaurar base de datos
mysql -u usuario -p nombre_base_datos < wordpress-db-backup-YYYYMMDD.sql

# 2. Restaurar archivos
tar -xzf wordpress-files-backup-YYYYMMDD.tar.gz
# Copiar al servidor en la ubicación correcta

# 3. Verificar wp-config.php
# Asegurarse que las credenciales de BD sean correctas

# 4. Verificar permisos
chmod 755 admin/
chmod 644 admin/wp-config.php
```

---

## ✅ CHECKLIST DE ENTREGA

### Archivos a Entregar
- [ ] Código fuente completo (ZIP del repositorio)
- [ ] Base de datos WordPress (.sql)
- [ ] Archivos WordPress (wp-content completo)
- [ ] Documentación de configuración
- [ ] Credenciales de acceso (documento separado y seguro)
- [ ] Este archivo BACKUP-ENTREGA.md

### Información a Documentar
- [ ] URLs del sitio (producción y prueba)
- [ ] Credenciales WordPress admin
- [ ] Credenciales hosting/servidor
- [ ] Credenciales base de datos
- [ ] Credenciales GitHub (si aplica)
- [ ] Emails configurados en el formulario
- [ ] Números de teléfono en el sitio

### Verificación Final
- [ ] Sitio funcional en producción
- [ ] Formulario de contacto enviando emails
- [ ] WordPress API respondiendo correctamente
- [ ] SEO optimizado (robots.txt, sitemap.xml)
- [ ] Imágenes cargando correctamente
- [ ] Responsive en móvil/tablet/desktop
- [ ] Velocidad de carga aceptable

---

## 📊 OPTIMIZACIONES SEO IMPLEMENTADAS

### Meta Tags
- ✅ Title optimizado
- ✅ Meta description
- ✅ Keywords
- ✅ Canonical URL
- ✅ Open Graph (Facebook)
- ✅ Twitter Cards
- ✅ OG Image configurado

### Archivos SEO
- ✅ robots.txt creado
- ✅ sitemap.xml generado
- ✅ Schema.org (JSON-LD)
- ✅ Alt text en imágenes
- ✅ Estructura H1 optimizada (solo uno por página)

### URLs Configuradas
- Producción: `https://ckdelap.cl`
- Prueba: `https://ckdelap.cl/prueba`

---

## 📧 CONFIGURACIÓN DE EMAILS

### Formulario de Contacto
- **Destino:** codigoraul@gmail.com, contacto@ckdelap.cl
- **Remitente:** formulario@ckdelap.cl
- **Nombre:** Camila Kush de la Puente - Psicóloga
- **Archivo:** `public/contacto.php`

### Redirecciones
- Éxito: `?status=success#contacto`
- Error: `?status=error#contacto`

---

## 🛠️ TECNOLOGÍAS UTILIZADAS

### Frontend
- **Framework:** Astro 4.x
- **Estilos:** CSS nativo (sin frameworks)
- **Fuentes:** Google Fonts (Inter, Poppins, Raleway, Playfair Display)
- **Iconos:** SVG inline

### Backend
- **CMS:** WordPress Headless
- **API:** WordPress REST API v2
- **Formulario:** PHP nativo (función mail())
- **Custom Post Types:** ACF + Custom Post Type UI

### Hosting
- **Archivos estáticos:** [Nombre del hosting]
- **WordPress:** [Nombre del hosting]
- **Base de datos:** MySQL

---

## 📞 SOPORTE Y CONTACTO

### Desarrollador
- **Nombre:** Código Raúl
- **Email:** codigoraul@gmail.com

### Cliente
- **Nombre:** Camila Kush de la Puente
- **Email:** contacto@ckdelap.cl
- **Teléfono:** +56 9 7887 4009

---

## 📝 NOTAS IMPORTANTES

### Cambios Pendientes al Mover a Producción
1. Cambiar `BASE_PATH` de `/prueba` a `''` en:
   - `public/contacto.php` (línea 5)
   - `public/contacto-config.php` (línea 6)

2. Actualizar sitemap.xml con URLs finales

3. Verificar que robots.txt apunte a la URL correcta

### Mantenimiento Recomendado
- Actualizar WordPress y plugins mensualmente
- Revisar backups semanalmente
- Monitorear emails del formulario
- Verificar Google Search Console para SEO

---

**Fecha de creación:** Marzo 2026  
**Versión:** 1.0  
**Estado:** Listo para entrega
