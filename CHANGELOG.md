# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)  
and this project adheres to [Semantic Versioning](https://semver.org/).

---

## [v1.4.0] - 2026-08-06

### Fixed

- Seo Manager supports Laravel version 13 in this update

## [v1.3.0] - 2025-10-09

### Added

- Auto-trimming of page slashes when storing SEO metadata, while allowing `'/'` for home page.
- Full support for home page `/` in `@seoAutoPage` directive.
- Enhanced `SeoManager` to fallback from page key to current URL automatically.
- Sidebar navigation improvements and dynamic count badges for all SEO types.
- Blade templates updated for responsive mobile sidebar toggling.

### Fixed

- Fixed issue with `/` home route not displaying SEO meta.
- Fixed bug with storing duplicate slashes in page SEO records.
- Improved `forPage()` and `findPageMeta()` to normalize paths consistently.

### Changed

- New trait `HasSeoMeta` added for get only seo free model instances.
- Updated `SeoMeta` model with a mutator for page attribute normalization.
- Improved `SeoServiceProvider` and Blade directives for seamless SEO rendering.

---

## [v1.2.1] - 2025-09-30

### Route Bug Fixed

- Ajax route bug fixed and dynamically realtime instance shown

---

## [v1.2.0] - 2025-09-30

### Added

- Introduced **Page Schema support** (JSON-LD / custom scripts) with textarea field in SEO settings
- Added Font Awesome `fa-code` icon for schema field section
- New placeholder text and helper description for schema editor

### Changed

- Improved form UX for schema editing (larger textarea with better readability)
- Updated UI consistency by using correct Font Awesome icons

---

## [v1.1.4] - 2025-09-24

### Changed

- Refactored package resources to be **publish-only** (migrations, views, and seeders)
- Updated Blade components and includes to use published paths (`areia.seo.*`)
- Removed automatic view and migration loading from the service provider
- Adjusted service provider to register component namespace only (`x-seo::`) without auto-loading views

---

## [v1.1.3] - 2025-09-14

### Changed

- Keywords added
- README.md Updated

---

## [v1.1.2] - 2025-09-10

### Changed

- Removed **Require Auth** option from configuration for easier setup
- Added **Dashboard screenshot** to documentation/README

---

## [v1.1.1] - 2025-09-05

### Removed

- Removed `docs/index.html` file from the project

### Changed

- Minor updates in documentation references after `docs.html` removal

---

## [v1.1.0] - 2025-09-04

### Added

- Fully redesigned documentation with **sticky left sidebar navigation**
- Sidebar is collapsible on mobile devices
- Examples updated for **layout, page, model, auto page, and combined usage**
- Improved Blade usage examples (`@seoGlobal`, `@seoPage`, `@seoModel`, `@seoAutoPage`)
- Enhanced readability and structure in docs with Tailwind styling

### Changed

- Updated README.md to reflect new documentation structure
- Minor code and documentation cleanup

---

## [v1.0.1] - 2025-09-04

### Fixed

- Resolved missing `resources/css/seo.css` in Vite manifest
- Ensured assets are correctly registered in `vite.config.js`

### Changed

- Improved Laravel 9–12 compatibility
- Minor code cleanup and updated documentation

---

## [v1.0.0] - 2025-09-03

### Added

- Initial stable release of `areia-lab/laravel-seo-solution`
- Tailwind UI backend for SEO management
- OpenGraph & Twitter meta tag support
- Blade components for SEO tags
- Compatible with Laravel 9, 10, 11, and 12
