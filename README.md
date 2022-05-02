# Simple Eve Industry API

This API returns basic information about Eve Online's industry blueprints. The main use is as a quick reference to see material input requirements and an estimated base cost for materials as well as the base value of the final product. Base prices are from CCP's static database, so will vary in the in-game marketplace.

## Installation

This project is built with Laravel (https://laravel.com) and uses the SQLite conversion of the Eve static database provded by Fuzzwork (https://www.fuzzwork.co.uk/dump/) so you will need PHP 7.3+ with the SQLite driver and Composer. After cloning, just run composter install, download the latest eve.db.bz2 from Fuzzwork (https://www.fuzzwork.co.uk/dump/latest/eve.db.bz2) and extract it to the storage/app directory, copy the .env.example file to .env and set your database to use the eve.db file (see below).

```
    DB_CONNECTION=sqlite
    DB_DATABASE=/absolute/path/to/eveapi/storage/app/eve.db #replace with the absolute path to your local repo
    DB_FOREIGN_KEYS=true
```

For info and general troubleshooting of the Laravel install, try the [Laravel Docs](https://laravel.com/docs/9.x)

Running `php artisan test` after installation will verify all endpoints are funcitoning correctly.

## Usage

This project has 3 api endpoints:

-   /api/blueprints #returns json of all blueprints with details, paginated
-   /api/blueprints/{blueprint} #uses the typeID key from the industryBlueprints table, returns json with details of a single blueprint
-   /api/blueprints/search/{keyword} #searches against blueprint name using `LIKE %keyword%` and returns paginated JSON with all matches

The /api/blueprints endpoint accepts an optional limit get variable e.g. /api/blueprints?limit=5. If not provided or not a valid number, it defaults to 10 results per page. All endpionts return results formatted as below:

```
{
"data": {
    "id": 785,
    "name": "Miner I Blueprint",
    "product": "Miner I",
    "materials": [
        {
        "id": 34,
        "name": "Tritanium",
        "quantity": "1324",
        "baseprice": "2"
        },
        {
        "id": 35,
        "name": "Pyerite",
        "quantity": "481",
        "baseprice": "8"
        },
        {
        "id": 36,
        "name": "Mexallon",
        "quantity": "119",
        "baseprice": "32"
        }
    ],
    "basecost": 10304,
    "basevalue": null,
    "baseprofit": -10304
    }
}
```

## To-do

-   add more data to the returns: production time, invention info, etc.
-   integrate CCP's live API for in-game market data to provide more accurate cost/profit info
-   set up auth and post endpoints to allow users to save info, eg. inventory, favorite blueprints, shopping lists, etc.

## Resources

-   [Eve Online](https://www.eveonline.com/)
-   [Laravel](https://laravel.com)
-   [Fuzzwork](https://www.fuzzwork.co.uk/)

## License

This work is licensed under the GNU General Public License v3.0

## CCP Copyright Notice

EVE Online, the EVE logo, EVE and all associated logos and designs are the intellectual property of CCP hf. All artwork, screenshots, characters, vehicles, storylines, world facts or other recognizable features of the intellectual property relating to these trademarks are likewise the intellectual property of CCP hf. EVE Online and the EVE logo are the registered trademarks of CCP hf. All rights are reserved worldwide. All other trademarks are the property of their respective owners. CCP hf. has granted permission to pyfa to use EVE Online and all associated logos and designs for promotional and information purposes on its website but does not endorse, and is not in any way affiliated with, pyfa. CCP is in no way responsible for the content on or functioning of this program, nor can it be liable for any damage arising from the use of this program.
