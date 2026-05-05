#!/bin/bash
# ============================================================
#  Hexham Bowling Club — LocalWP Demo Setup
# ============================================================
#  HOW TO USE:
#  1. Open LocalWP → create a new site (any name)
#  2. Right-click the site → "Open Site Shell"
#  3. In the shell, run:  bash /path/to/setup.sh
#     (or copy this file into the site root first, then: bash setup.sh)
# ============================================================

set -e

GREEN='\033[0;32m'
NC='\033[0m'
log() { echo -e "${GREEN}▶ $1${NC}"; }

# ── 1. Clone theme ──────────────────────────────────────────
log "Cloning theme from GitHub..."
cd wp-content/themes
if [ -d "hexham-bc" ]; then
  echo "  hexham-bc already exists — skipping clone"
else
  git clone https://github.com/SimpleScrub/HexhamProject.git _tmp_repo
  cp -r _tmp_repo/wp-content/themes/hexham-bc ./hexham-bc
  rm -rf _tmp_repo
fi
cd ../..

# ── 2. Activate theme ───────────────────────────────────────
log "Activating theme..."
wp theme activate hexham-bc

# ── 3. Plugins ──────────────────────────────────────────────
log "Installing plugins..."
wp plugin install advanced-custom-fields --activate --quiet
wp plugin install wpforms-lite --activate --quiet

# ── 4. Clean default content ────────────────────────────────
log "Removing default WordPress content..."
wp post delete $(wp post list --post_type=post --field=ID) --force 2>/dev/null || true
wp post delete $(wp post list --post_type=page --field=ID) --force 2>/dev/null || true

# ── 5. Create pages ─────────────────────────────────────────
log "Creating pages..."

HOME_ID=$(wp post create \
  --post_type=page --post_title='Home' \
  --post_status=publish --porcelain)

WHATSON_ID=$(wp post create \
  --post_type=page --post_title="What's On" \
  --post_status=publish --page_template=page-whats-on.php --porcelain)

BOWLS_ID=$(wp post create \
  --post_type=page --post_title='Bowls' \
  --post_status=publish --page_template=page-bowls.php --porcelain)

FUNCTIONS_ID=$(wp post create \
  --post_type=page --post_title='Functions & Events' \
  --post_status=publish --page_template=page-functions.php --porcelain)

DINING_ID=$(wp post create \
  --post_type=page --post_title='Dining' \
  --post_status=publish --page_template=page-dining.php --porcelain)

ACCOM_ID=$(wp post create \
  --post_type=page --post_title='Accommodation' \
  --post_status=publish --page_template=page-accommodation.php --porcelain)

MEMBER_ID=$(wp post create \
  --post_type=page --post_title='Membership' \
  --post_status=publish --page_template=page-membership.php --porcelain)

ABOUT_ID=$(wp post create \
  --post_type=page --post_title='About Us' \
  --post_status=publish --page_template=page-about.php --porcelain)

CONTACT_ID=$(wp post create \
  --post_type=page --post_title='Contact' \
  --post_status=publish --page_template=page-contact.php --porcelain)

# ── 6. Set static front page ────────────────────────────────
log "Setting front page..."
wp option update show_on_front page
wp option update page_on_front $HOME_ID

# ── 7. Nav menu ─────────────────────────────────────────────
log "Building navigation menu..."
wp menu create "Primary"
wp menu location assign primary primary
for ID in $HOME_ID $WHATSON_ID $BOWLS_ID $FUNCTIONS_ID $DINING_ID $ACCOM_ID $MEMBER_ID $ABOUT_ID $CONTACT_ID; do
  wp menu item add-post primary $ID
done

# ── 8. Demo events ──────────────────────────────────────────
log "Creating demo events..."
TODAY=$(date +%Y-%m-%d)
NEXT_SAT=$(date -d "next saturday" +%Y-%m-%d 2>/dev/null || date +%Y-%m-%d)
NEXT_FRI=$(date -d "next friday" +%Y-%m-%d 2>/dev/null || date +%Y-%m-%d)
YEAR_END="$(date +%Y)-12-31"

# Helper: set ACF field (value + reference)
acf_set() {
  local POST_ID=$1 FIELD_NAME=$2 FIELD_KEY=$3 VALUE=$4
  wp post meta update $POST_ID $FIELD_NAME "$VALUE"
  wp post meta update $POST_ID "_$FIELD_NAME" "$FIELD_KEY"
}

# Event 1 — Recurring weekly bowls
E1=$(wp post create --post_type=hbc_event \
  --post_title='Saturday Nominated 3s' \
  --post_excerpt='Weekly nominated triples — jackpot available. Names in by 10am.' \
  --post_status=publish --porcelain)
acf_set $E1 event_date      field_event_date      "$TODAY"
acf_set $E1 event_start_time field_event_start_time "12:30:00"
acf_set $E1 event_type      field_event_type      "bowls"
acf_set $E1 is_recurring    field_is_recurring    "1"
acf_set $E1 recurrence_rule field_recurrence_rule "weekly"
acf_set $E1 recurrence_end_date field_recurrence_end_date "$YEAR_END"

# Event 2 — Live music
E2=$(wp post create --post_type=hbc_event \
  --post_title='Live Music Night' \
  --post_excerpt='Live entertainment in the main lounge. All welcome — no cover charge.' \
  --post_status=publish --porcelain)
acf_set $E2 event_date       field_event_date       "$NEXT_FRI"
acf_set $E2 event_start_time field_event_start_time "19:00:00"
acf_set $E2 event_end_time   field_event_end_time   "22:00:00"
acf_set $E2 event_type       field_event_type       "live_music"
acf_set $E2 is_recurring     field_is_recurring     "0"

# Event 3 — Recurring weekly raffle
E3=$(wp post create --post_type=hbc_event \
  --post_title='Meat Tray Raffle' \
  --post_excerpt='Weekly meat tray raffle every Saturday evening. Tickets from the bar.' \
  --post_status=publish --porcelain)
acf_set $E3 event_date       field_event_date       "$TODAY"
acf_set $E3 event_start_time field_event_start_time "18:00:00"
acf_set $E3 event_type       field_event_type       "raffle"
acf_set $E3 is_recurring     field_is_recurring     "1"
acf_set $E3 recurrence_rule  field_recurrence_rule  "weekly"
acf_set $E3 recurrence_end_date field_recurrence_end_date "$YEAR_END"

# Event 4 — Promotion
E4=$(wp post create --post_type=hbc_event \
  --post_title='Members Happy Hour' \
  --post_excerpt='Discounted drinks for all members every Friday from 5pm.' \
  --post_status=publish --porcelain)
acf_set $E4 event_date       field_event_date       "$NEXT_FRI"
acf_set $E4 event_start_time field_event_start_time "17:00:00"
acf_set $E4 event_end_time   field_event_end_time   "18:00:00"
acf_set $E4 event_type       field_event_type       "promotion"
acf_set $E4 is_recurring     field_is_recurring     "1"
acf_set $E4 recurrence_rule  field_recurrence_rule  "weekly"
acf_set $E4 recurrence_end_date field_recurrence_end_date "$YEAR_END"

# ── Done ────────────────────────────────────────────────────
echo ""
echo "============================================"
echo "  Setup complete!"
echo "  Site:   $(wp option get siteurl)"
echo "  Admin:  $(wp option get siteurl)/wp-admin"
echo "============================================"
echo ""
echo "To share with client: LocalWP → your site → enable Live Link"
echo ""
