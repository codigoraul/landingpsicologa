#!/bin/bash

# Script de Respaldo Automático - Landing Psicóloga
# Fecha: Marzo 2026

# Colores para output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}  RESPALDO LANDING PSICÓLOGA${NC}"
echo -e "${BLUE}========================================${NC}\n"

# Fecha actual
FECHA=$(date +%Y%m%d-%H%M%S)
BACKUP_DIR="backup-$FECHA"

# Crear directorio de backup
mkdir -p "$BACKUP_DIR"
echo -e "${GREEN}✓${NC} Directorio de backup creado: $BACKUP_DIR"

# 1. Backup del repositorio Git
echo -e "\n${YELLOW}1. Respaldando repositorio Git...${NC}"
git bundle create "$BACKUP_DIR/landingpsicologa-repo.bundle" --all
echo -e "${GREEN}✓${NC} Repositorio Git respaldado"

# 2. Copiar archivos del proyecto
echo -e "\n${YELLOW}2. Copiando archivos del proyecto...${NC}"
rsync -av --exclude='node_modules' --exclude='dist' --exclude='.git' --exclude='backup-*' . "$BACKUP_DIR/codigo-fuente/"
echo -e "${GREEN}✓${NC} Código fuente copiado"

# 3. Copiar documentación
echo -e "\n${YELLOW}3. Copiando documentación...${NC}"
cp BACKUP-ENTREGA.md "$BACKUP_DIR/" 2>/dev/null || echo "BACKUP-ENTREGA.md no encontrado"
cp README.md "$BACKUP_DIR/" 2>/dev/null || echo "README.md no encontrado"
echo -e "${GREEN}✓${NC} Documentación copiada"

# 4. Crear archivo de información
echo -e "\n${YELLOW}4. Creando archivo de información...${NC}"
cat > "$BACKUP_DIR/INFO-BACKUP.txt" << EOF
INFORMACIÓN DEL RESPALDO
========================

Fecha de respaldo: $(date)
Proyecto: Landing Psicóloga - Camila Kush de la Puente
Dominio: https://ckdelap.cl

CONTENIDO DEL BACKUP:
- landingpsicologa-repo.bundle: Repositorio Git completo
- codigo-fuente/: Código fuente del proyecto
- BACKUP-ENTREGA.md: Documentación completa

RESTAURAR REPOSITORIO GIT:
git clone landingpsicologa-repo.bundle landingpsicologa
cd landingpsicologa
npm install

ÚLTIMO COMMIT:
$(git log -1 --pretty=format:"%h - %an, %ar : %s")

ARCHIVOS INCLUIDOS:
$(find codigo-fuente -type f | wc -l) archivos

TAMAÑO TOTAL:
$(du -sh . | cut -f1)
EOF
echo -e "${GREEN}✓${NC} Archivo de información creado"

# 5. Comprimir todo
echo -e "\n${YELLOW}5. Comprimiendo backup...${NC}"
tar -czf "landingpsicologa-backup-$FECHA.tar.gz" "$BACKUP_DIR"
BACKUP_SIZE=$(du -sh "landingpsicologa-backup-$FECHA.tar.gz" | cut -f1)
echo -e "${GREEN}✓${NC} Backup comprimido: landingpsicologa-backup-$FECHA.tar.gz ($BACKUP_SIZE)"

# 6. Limpiar directorio temporal
echo -e "\n${YELLOW}6. Limpiando archivos temporales...${NC}"
rm -rf "$BACKUP_DIR"
echo -e "${GREEN}✓${NC} Limpieza completada"

# Resumen final
echo -e "\n${BLUE}========================================${NC}"
echo -e "${GREEN}✓ RESPALDO COMPLETADO EXITOSAMENTE${NC}"
echo -e "${BLUE}========================================${NC}"
echo -e "\nArchivo generado: ${GREEN}landingpsicologa-backup-$FECHA.tar.gz${NC}"
echo -e "Tamaño: ${GREEN}$BACKUP_SIZE${NC}\n"
echo -e "Para restaurar:"
echo -e "  tar -xzf landingpsicologa-backup-$FECHA.tar.gz"
echo -e "  git clone backup-*/landingpsicologa-repo.bundle landingpsicologa\n"
