# 🛒 Laravel Ecommerce RESTful API

Hayda el project huwwe API kâmle la-nizam e-commerce sghir, bi-khalle el users y-shoufo products w ya3mlo orders, ma3 nizam roles (Admin/User).

## 🚀 Features
- **Authentication:** M-nesta3mel **Laravel Sanctum** krmal el secure login.
- **Roles Management:** - **Admin:** Fiyo y-zid, y-3addel, aw y-shil products.
    - **User:** Fiyo y-shouf el products w ya3mel order.
- **Order Logic:** El User fiyo ya3mel order la-ktit items sawa.
- **Stock Management:** El stock bi-onous otomatikiyan bas y-sir fi order.
- **Database Migrations:** El schema jâhez lal products, orders, w users.

## 🛠️ Tech Stack
- **Framework:** Laravel 11
- **Language:** PHP 8.2+
- **Database:** MySQL / SQLite
- **Tools:** Postman for testing

## 💻 Installation
1. `git clone https://github.com/wejdndnd-boop/laravel-ecommerce-api.git`
2. `composer install`
3. `cp .env.example .env`
4. `php artisan key:generate`
5. `php artisan migrate --seed` (Krmal t-nazzil el products el tajribiye)
6. `php artisan serve`

## 🔗 Main API Endpoints
| Method | Endpoint | Access | Description |
|---|---|---|---|
| POST | `/api/register` | Public | Create new account |
| POST | `/api/login` | Public | Get Auth Token |
| GET | `/api/products` | Public | View all products |
| POST | `/api/products` | Admin | Add new product |
| POST | `/api/orders` | User | Place a new order |

---
Created with 💪 by Asaad