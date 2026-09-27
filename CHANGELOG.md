# Changelog

All notable changes to this project are documented here. The format follows
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and the project uses
[semantic versioning](https://semver.org/).

## [Unreleased]

### Added
- MIT license, `LICENSE`, `composer.json` and the `config.xml` manifest (only the Polish one existed).
- English and Polish translation catalogues (`Modules.M4pshortproductdate.Admin` and `.Shop`).
- `index.php` guards in every directory.

### Fixed
- Saving a product from a screen without the expiry form no longer overwrites its date: the hook
  returns early when the field was not submitted.
- The submitted date is validated before it reaches the database, and an empty value is stored as
  `NULL` instead of an invalid timestamp.

### Changed
- Back-office and front-office strings now go through the new translation system instead of
  `$this->l()` and `{l s=… mod=…}`; the Yes/No labels were hardcoded Polish and are translated now.
- Declared PrestaShop compatibility from 1.7.6.

## [1.0.0] — 2025-10-08

### Added
- First release: a short expiry date per product, shown on the product page.
