USE almoqadas;

-- packages
ALTER TABLE packages
  ADD COLUMN title_en       VARCHAR(200) NOT NULL DEFAULT '' AFTER title,
  ADD COLUMN title_ps       VARCHAR(200) NOT NULL DEFAULT '' AFTER title_en,
  ADD COLUMN title_fa       VARCHAR(200) NOT NULL DEFAULT '' AFTER title_ps,
  ADD COLUMN description_en TEXT         AFTER description,
  ADD COLUMN description_ps TEXT         AFTER description_en,
  ADD COLUMN description_fa TEXT         AFTER description_ps,
  ADD COLUMN destination_en VARCHAR(120) NOT NULL DEFAULT '' AFTER destination,
  ADD COLUMN destination_ps VARCHAR(120) NOT NULL DEFAULT '' AFTER destination_en,
  ADD COLUMN destination_fa VARCHAR(120) NOT NULL DEFAULT '' AFTER destination_ps;

-- posts
ALTER TABLE posts
  ADD COLUMN title_en       VARCHAR(200) NOT NULL DEFAULT '' AFTER title,
  ADD COLUMN title_ps       VARCHAR(200) NOT NULL DEFAULT '' AFTER title_en,
  ADD COLUMN title_fa       VARCHAR(200) NOT NULL DEFAULT '' AFTER title_ps,
  ADD COLUMN excerpt_en     TEXT         AFTER excerpt,
  ADD COLUMN excerpt_ps     TEXT         AFTER excerpt_en,
  ADD COLUMN excerpt_fa     TEXT         AFTER excerpt_ps,
  ADD COLUMN content_en     LONGTEXT     AFTER content,
  ADD COLUMN content_ps     LONGTEXT     AFTER content_en,
  ADD COLUMN content_fa     LONGTEXT     AFTER content_ps,
  ADD COLUMN author_en      VARCHAR(120) NOT NULL DEFAULT '' AFTER author,
  ADD COLUMN author_ps      VARCHAR(120) NOT NULL DEFAULT '' AFTER author_en,
  ADD COLUMN author_fa      VARCHAR(120) NOT NULL DEFAULT '' AFTER author_ps;

-- services
ALTER TABLE services
  ADD COLUMN title_en       VARCHAR(120) NOT NULL DEFAULT '' AFTER title,
  ADD COLUMN title_ps       VARCHAR(120) NOT NULL DEFAULT '' AFTER title_en,
  ADD COLUMN title_fa       VARCHAR(120) NOT NULL DEFAULT '' AFTER title_ps,
  ADD COLUMN tag_en         VARCHAR(60)  NOT NULL DEFAULT '' AFTER tag,
  ADD COLUMN tag_ps         VARCHAR(60)  NOT NULL DEFAULT '' AFTER tag_en,
  ADD COLUMN tag_fa         VARCHAR(60)  NOT NULL DEFAULT '' AFTER tag_ps,
  ADD COLUMN description_en TEXT         AFTER description,
  ADD COLUMN description_ps TEXT         AFTER description_en,
  ADD COLUMN description_fa TEXT         AFTER description_ps;

-- faqs
ALTER TABLE faqs
  ADD COLUMN question_en    VARCHAR(255) NOT NULL DEFAULT '' AFTER question,
  ADD COLUMN question_ps    VARCHAR(255) NOT NULL DEFAULT '' AFTER question_en,
  ADD COLUMN question_fa    VARCHAR(255) NOT NULL DEFAULT '' AFTER question_ps,
  ADD COLUMN answer_en      TEXT         NOT NULL AFTER answer,
  ADD COLUMN answer_ps      TEXT         NOT NULL AFTER answer_en,
  ADD COLUMN answer_fa      TEXT         NOT NULL AFTER answer_ps;

-- hero_slides
ALTER TABLE hero_slides
  ADD COLUMN label_en       VARCHAR(120) NOT NULL DEFAULT '' AFTER label,
  ADD COLUMN label_ps       VARCHAR(120) NOT NULL DEFAULT '' AFTER label_en,
  ADD COLUMN label_fa       VARCHAR(120) NOT NULL DEFAULT '' AFTER label_ps;

-- awards
ALTER TABLE awards
  ADD COLUMN label_en       VARCHAR(120) NOT NULL DEFAULT '' AFTER label,
  ADD COLUMN label_ps       VARCHAR(120) NOT NULL DEFAULT '' AFTER label_en,
  ADD COLUMN label_fa       VARCHAR(120) NOT NULL DEFAULT '' AFTER label_ps;

-- testimonials
ALTER TABLE testimonials
  ADD COLUMN name_en        VARCHAR(120) NOT NULL DEFAULT '' AFTER name,
  ADD COLUMN name_ps        VARCHAR(120) NOT NULL DEFAULT '' AFTER name_en,
  ADD COLUMN name_fa        VARCHAR(120) NOT NULL DEFAULT '' AFTER name_ps,
  ADD COLUMN position_en    VARCHAR(120) NOT NULL DEFAULT '' AFTER position,
  ADD COLUMN position_ps    VARCHAR(120) NOT NULL DEFAULT '' AFTER position_en,
  ADD COLUMN position_fa    VARCHAR(120) NOT NULL DEFAULT '' AFTER position_ps,
  ADD COLUMN content_en     TEXT         AFTER content,
  ADD COLUMN content_ps     TEXT         AFTER content_en,
  ADD COLUMN content_fa     TEXT         AFTER content_ps;

-- team_members
ALTER TABLE team_members
  ADD COLUMN name_en        VARCHAR(120) NOT NULL DEFAULT '' AFTER name,
  ADD COLUMN name_ps        VARCHAR(120) NOT NULL DEFAULT '' AFTER name_en,
  ADD COLUMN name_fa        VARCHAR(120) NOT NULL DEFAULT '' AFTER name_ps,
  ADD COLUMN role_en        VARCHAR(120) NOT NULL DEFAULT '' AFTER role,
  ADD COLUMN role_ps        VARCHAR(120) NOT NULL DEFAULT '' AFTER role_en,
  ADD COLUMN role_fa        VARCHAR(120) NOT NULL DEFAULT '' AFTER role_ps,
  ADD COLUMN bio_en         TEXT         AFTER bio,
  ADD COLUMN bio_ps         TEXT         AFTER bio_en,
  ADD COLUMN bio_fa         TEXT         AFTER bio_ps;

-- timeline_items
ALTER TABLE timeline_items
  ADD COLUMN year_en        VARCHAR(20)  NOT NULL DEFAULT '' AFTER year,
  ADD COLUMN year_ps        VARCHAR(20)  NOT NULL DEFAULT '' AFTER year_en,
  ADD COLUMN year_fa        VARCHAR(20)  NOT NULL DEFAULT '' AFTER year_ps,
  ADD COLUMN title_en       VARCHAR(255) NOT NULL DEFAULT '' AFTER title,
  ADD COLUMN title_ps       VARCHAR(255) NOT NULL DEFAULT '' AFTER title_en,
  ADD COLUMN title_fa       VARCHAR(255) NOT NULL DEFAULT '' AFTER title_ps,
  ADD COLUMN text_en        TEXT         AFTER text,
  ADD COLUMN text_ps        TEXT         AFTER text_en,
  ADD COLUMN text_fa        TEXT         AFTER text_ps;

-- page_sections
ALTER TABLE page_sections
  ADD COLUMN label_en       VARCHAR(200) NOT NULL DEFAULT '' AFTER label,
  ADD COLUMN label_ps       VARCHAR(200) NOT NULL DEFAULT '' AFTER label_en,
  ADD COLUMN label_fa       VARCHAR(200) NOT NULL DEFAULT '' AFTER label_ps,
  ADD COLUMN content_en     LONGTEXT     AFTER content,
  ADD COLUMN content_ps     LONGTEXT     AFTER content_en,
  ADD COLUMN content_fa     LONGTEXT     AFTER content_ps;
