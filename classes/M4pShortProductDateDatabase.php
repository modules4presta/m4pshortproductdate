<?php

/**
 * m4pshortproductdate
 *
 * @author    Modules4Presta <contact@modules4presta.io>
 * @copyright 2026 Nice Code sp. z o.o. (Modules4Presta)
 * @license   https://opensource.org/licenses/MIT MIT License
 */

class M4pShortProductDateDatabase
{
    public $sqlQueries = [];
    public $DB_tables = ['m4pshortproductdate_dates'];

    public function installQueries()
    {
        $this->sqlQueries[] = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "m4pshortproductdate_dates` (
            `id_date` int(20) AUTO_INCREMENT PRIMARY KEY,
            `id_product` int(20) NOT NULL,
            `active` tinyint(1),
            `date` timestamp,
            UNIQUE KEY `unique_product` (`id_product`)
        )";

        foreach ($this->sqlQueries as $query) {
            if (Db::getInstance()->execute($query) === false) {
                return false;
            }
        }
        return true;
    }

    public function uninstallQueries()
    {
        foreach ($this->DB_tables as $table) {
            if (Db::getInstance()->execute("DROP TABLE IF EXISTS `" . _DB_PREFIX_ . $table . "`;") === false) {
                return false;
            }
        }
        return true;
    }
}
