# Magento 1.9 Export categories module
A Magento 1.9's module to export categories information to a .XLSX or .CSV file.

## Module informations
`Package/Namespace`: "Matheus"  

`Modulename`: "ExportCat"

`codepool`: "community"  

## How to install
Add the folder `Matheus` inside `/app/code/community/` and add the file `Matheus_ExportCat.xml` inside `/app/etc/modules/`

## How to use
After installation a new submenu named `Export Categories` will be created at the menu `Catalog` in your admin panel. Click in it to enter the module's page. 



Now, you just need to select the format of the file and press the button `Export` to generate the sheet, that will be automatically downloaded in your browser, containing the meaningful informations about the categories in your store.



## Output file
The following columns will be present in the generated file:
|name|id|description|is_active|url_key|parent_id|parent_name|
| --- | --- | --- | --- | --- | --- | --- |
|Default Category|2|Description of catalog|1|default-category|1|Root Catalog|
|Category 2|3|Second description|0|category-2|2|Default Category|
|Category 3|4|Third description|1|category-3|3|Category 2|
