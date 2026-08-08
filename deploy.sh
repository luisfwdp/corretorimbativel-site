#!/usr/bin/env bash
#
# Deploy the Corretor Imbatível theme to the WordPress install on cPanel.
#
# Usage (run ON THE SERVER, inside the Git Version Control repo checkout):
#   ./deploy.sh /home/USUARIO/public_html
#
# The script only ever touches wp-content/themes/corretor-imbativel inside
# the target WordPress install. It never touches wp-config.php or
# wp-content/uploads. It aborts on the first error (set -e) so a partial,
# broken deploy never gets left in place.

set -euo pipefail

THEME_SLUG="corretor-imbativel"
REPO_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
SOURCE_THEME="${REPO_DIR}/wp-content/themes/${THEME_SLUG}"

if [ "$#" -ne 1 ]; then
	echo "Uso: ./deploy.sh /caminho/para/public_html" >&2
	exit 1
fi

WP_ROOT="$1"
TARGET_THEME="${WP_ROOT}/wp-content/themes/${THEME_SLUG}"

if [ ! -d "${SOURCE_THEME}" ]; then
	echo "ERRO: tema não encontrado em ${SOURCE_THEME}" >&2
	exit 1
fi

if [ ! -d "${WP_ROOT}/wp-content/themes" ]; then
	echo "ERRO: ${WP_ROOT} não parece uma instalação WordPress válida (wp-content/themes ausente)" >&2
	exit 1
fi

if [ ! -f "${SOURCE_THEME}/style.css" ] || [ ! -f "${SOURCE_THEME}/functions.php" ]; then
	echo "ERRO: tema incompleto (style.css ou functions.php ausente). Deploy abortado." >&2
	exit 1
fi

echo "Sincronizando tema '${THEME_SLUG}' para ${TARGET_THEME} ..."

mkdir -p "${TARGET_THEME}"

rsync -av --delete \
	--exclude ".git" \
	--exclude ".gitignore" \
	"${SOURCE_THEME}/" "${TARGET_THEME}/"

echo "Deploy concluído com sucesso."
echo "Nada em wp-content/uploads ou wp-config.php foi alterado."
