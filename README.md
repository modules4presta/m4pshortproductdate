# M4P Short Expiry Date for PrestaShop 8 & 9

**Tell customers the exact expiry date of the batch you are selling — before they order, not after the parcel arrives.**

> **Meta description (147 chars):** Show a short expiry date on PrestaShop product pages. Sell short-dated batches honestly, with one date field per product. Free MIT module.

---

## Why short-dated stock needs its own field

Food, cosmetics, chemicals and supplements all lose value as the expiry date approaches. Shops end
up with batches that are perfectly good but close to the date, and two bad options: sell them
quietly and deal with complaints, or write them off.

- **Complaints drop** — the customer saw the date before ordering, so nothing is a surprise
- **Short-dated stock sells** — an honest date plus a lower price moves goods that would expire
- **Wholesale buyers need it** — a shop reselling your goods has to know how much shelf life is left
- **One field instead of a note in the description** — no editing descriptions by hand

## What the module does

The module adds an expiry date to the product edit page. When the date is switched on, it appears on
the product page in the front office, under the product information. Nothing else changes — no
price rules, no stock handling.

### Key features

- **One date per product**, edited where the product is edited
- **A switch per product** — the date is stored but shown only when you turn it on
- **Visible where it matters** — on the product page, next to the rest of the product details
- **No configuration screen** — the module has no global settings to get wrong

### What it does not do

The module does not change prices, does not hide the product when the date passes and does not warn
you when a date is approaching. It states a fact for the customer; the commercial decisions stay
with you.

## Compatibility

| | |
|---|---|
| PrestaShop | 1.7.6 – 9.x |
| PHP | 7.2.5+ |
| Requirements | none |
| Multistore | Dates are shared across shops |
| Themes | Needs a theme that renders `displayProductAdditionalInfo` (all standard themes do) |

The module performs no core overrides. It creates one table,
`m4pshortproductdate_dates`, and drops it on uninstall.

## Installation

1. Upload and install the module from **Modules → Module Manager**.
2. Open a product in **Catalogue → Products**.
3. Set the expiry date, switch the option on and save.
4. Open the product page in the front office — the date is shown with the product details.

## Configuration options

Everything is set per product, in the product edit page:

| Field | Description |
|---|---|
| **Active lower date** | Shows or hides the date on the product page. The date itself stays saved. |
| **Date** | The expiry date of the batch currently on sale. |

## Frequently asked questions

**Does the product disappear when the date passes?**
No. The module only displays the date. Withdrawing the product stays a manual decision.

**Can I set a different date per combination?**
No, the date is stored per product. Products sold in several batches at once need separate products.

**What happens to the dates when I uninstall the module?**
The table is dropped, so every date is removed. Export it first if you plan to reinstall.

**Is the date visible in the cart or on the invoice?**
No, only on the product page. Add it to the product description if it has to appear on documents.

---

**Keywords:** PrestaShop expiry date, short dated products, best before date, food shop PrestaShop,
batch expiry, shelf life.

## License

MIT — see [LICENSE](LICENSE). Free to use commercially, fork and modify; keep the copyright notice.

## Contributing

Bug reports and pull requests are welcome — see [CONTRIBUTING.md](CONTRIBUTING.md). For security
issues, follow [SECURITY.md](SECURITY.md) instead of opening a public issue.

---

Built by [Nice Code](https://nice-code.com/pl/oferta/moduly-prestashop) — we build and maintain PrestaShop stores.

© Nice Code sp. z o.o. (Modules4Presta) — released under the MIT license.
