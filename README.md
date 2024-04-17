# Laravel 11 Alpha Vantage 具象狀態傳輸應用程式介面用戶端

Alpha Vantage 通過一組功能強大且對開發人員友好的 API 提供企業級金融市場數據。從傳統資產類別（例如股票和 指數股票型基金（ETF））到外匯和加密貨幣，從基本數據到技術指標，Alpha Vantage 是您通過基於雲端的 API、Excel 和 Google 試算表提供的全球市場數據的一站式商店。

## 使用方式
- 把整個專案複製一份到你的電腦裡，這裡指的「內容」不是只有檔案，而是指所有整個專案的歷史紀錄、分支、標籤等內容都會複製一份下來。
```sh
$ git clone
```
- 將 __.env.example__ 檔案重新命名成 __.env__，如果應用程式金鑰沒有被設定的話，你的使用者 sessions 和其他加密的資料都是不安全的！
- 當你的專案中已經有 composer.lock，可以直接執行指令以讓 Composer 安裝 composer.lock 中指定的套件及版本。
```sh
$ composer install
```
- 產生 Laravel 要使用的一組 32 字元長度的隨機字串 APP_KEY 並存在 .env 內。
```sh
$ php artisan key:generate
```
- 在瀏覽器中輸入已定義的路由 URL 來訪問，例如：http://127.0.0.1:8000。
- 你可以經由 `/alpha_vantage/time_series_intraday` 來進行 Alpha Vantage 日內時間序列資訊取得。
- 你可以經由 `/alpha_vantage/currency_exchange_rate` 來進行 Alpha Vantage 貨幣匯率取得。

----

## 畫面截圖
![](https://i.imgur.com/EuICIYu.png)
> 取得每六十分鐘的日內資訊

![](https://i.imgur.com/TEzUzeU.png)
> 取得最新的貨幣匯率資訊
