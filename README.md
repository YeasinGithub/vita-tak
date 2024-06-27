

## 1.laravel project

Setup And Run

```bash
1.clone github project.
2.env file setup.
3.php artisan migrate.
3.php artisan passport:install
   If want yes or no Command then click YES or yes
```
## 2.Authentication

```bash
1.User registration By Postman 
    Created By this URL 127.0.0.1:8000/api/register
2.User Login:
    Created By this URL 127.0.0.1:8000/api/login

```
## 3.Factory Data Insert

Run This Command
```bash
1.php artisan db:seed
```
## 4.Product Store

```bash
1.Product Store By Postman 

   Created By this URL 127.0.0.1:8000/api/product

   *Header Setup
   *Body Click then Raw Click Then pest Below This code
    {
    "name": "Product Name",
    "sku": "SKU001",
    "symbology": "EAN13",
    "brand_id": 1,
    "category_id": 1,
    "unit_id": 1,
    "price": 100.00,
    "qty": 10,
    "alert_qty": 2,
    "tax_method": "inclusive",
    "tax_id": 1,
    "has_stock": true,
    "has_expired_date": false,
    "details": "Product details here",
    "product_qties": [
        {
            "warehouse_id": 1,
            "qty": 50
        },
        {
            "warehouse_id": 2,
            "qty": 30
        }
    ],
        "attachments": [
        {
            "url": "https://upload.wikimedia.org/wikipedia/commons/f/f9/Flag_of_Bangladesh.svg",
            "state": "product",
            "lable":"attachments",
            "file":"Flag_of_Bangladesh.svg",
            "content_type":"svg",
            "user":"Undefined User"
        },
         {
            "url": "https://upload.wikimedia.org/wikipedia/commons/f/f9/Flag_of_Bangladesh.svg",
            "state": "product",
            "lable":"attachments",
            "file":"Flag_of_Bangladesh.svg",
            "content_type":"svg",
            "user":"Undefined User"
        }
    ]
}


   *note: postman Authoraization select type and Option Selected "Bearer Token"
          Then right side Login token pest
```
## 5.All Product Show

```bash
1.Product Show

   Show By this URL 127.0.0.1:8000/api/product

   *note: postman Authoraization select type and Option Selected "Bearer Token"
          Then right side Login token pest
```
## 5.Product update

```bash
1.Product Update

   Updated By this URL 127.0.0.1:8000/api/product/1

   *note: postman Authoraization select type and Option Selected "Bearer Token"
          Then right side Login token pest
```
## 6.Product Delete

```bash
1.Product Delete

   Deleted By this URL 127.0.0.1:8000/api/product/1

   *note: postman Authoraization select type and Option Selected "Bearer Token"
          Then right side Login token pest
```
## 7.Single Product Show

```bash
1.Single Product Show

   Show By this URL 127.0.0.1:8000/api/product/1

   *note: postman Authoraization select type and Option Selected "Bearer Token"
          Then right side Login token pest
```
