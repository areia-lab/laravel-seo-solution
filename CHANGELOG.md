# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)  
and this project adheres to [Semantic Versioning](https://semver.org/).

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
