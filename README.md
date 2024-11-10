# AsiaYoQuiz
 AsiaYo_亞洲遊 面試前測驗

## 資料庫測驗
### 題目一
 Q: 請寫出一條查詢語句 (SQL)，列出在 2023 年 5 月下訂的訂單，使用台幣付款且5月總金額最多的前 10 筆的旅宿 ID (bnb_id), 旅宿名稱 (bnb_name), 5 月總金額 (may_amount)

 A:
```
SET @may_start = 1682899200;
SET @may_end = 1685577599;
SELECT rooms.bnb_id, bnbs.name, SUM(amount) AS `may_amount`
FROM orders
JOIN rooms ON orders.room_id = rooms.id
JOIN bnbs ON rooms.bnb_id = bnbs.id
WHERE orders.created_at BETWEEN @may_start AND @may_end
AND orders.currency = 'TWD'
GROUP BY rooms.bnb_id
ORDER BY may_amount DESC
LIMIT 10;
```

### 題目二
 Q: 在題目一的執行下，我們發現 SQL 執行速度很慢，您會怎麼去優化？請闡述您怎麼判斷與優化的方式

 A: 我通常先下 `EXPLAIN` 去看, 看哪段步驟所需要查詢的資料量最多, 雖然我並未真的針對此題去建DB, 但根據經驗, 查 `created_at` 或 `currency` 欄位時會查詢整張表, 效能自然差. 所以我遇到這種狀況可能至少建 `created_at` 的 index, 或是 `created_at + currency` 的 index, 視情況而定.

 nit: `orders`表疑似有多餘的資料(欄位`bnb_id`), 其功能完全可被 `room_id` 取代, 有可能造成資料不一致, 若確認過busisness logic後確定用不到則應刪除

## API 實作測驗
### 題目一
請用 Laravel 實作一個提供訂單格式檢查與轉換的 API
* 此應用程式將有一支 endpoint 為 POST /api/orders 的 API 作為輸入點
    * 90b5137

* 此 API 將以以下固定的 JSON 格式輸入，並請使用 Laravel 的 FormRequest，若未使
用 FormRequest 物件，不予給分
    * 90b5137
    * c03423c

* 請按照循序圖實作此 API 的互動類別及其衍生類別。實作之類別需符合物件導向設計
原則 SOLID 與設計模式。並於該此專案的 README.md 說明您所使用的 SOLID 與
    * 目前只想到 service 裡 transformer 的依賴注入, 若有其它的, 因為很自然就使用了, 所以沒察覺到.

設計模式分別為何。
* 此 API 需按照以下心智圖之所有情境，處理訂單檢查格式與轉換的功能。
    * c03423c

* 以下所有情境皆需附上單元測試，覆蓋成功與失敗之案例。
    * e92f034
    * dcbdb4d

* 請使用 docker 包裝您的環境。若未使用 docker 或 docker-compose 不予給分
    * bbd8f2e

* 實作結果需以 GitHub 呈現。若未使用不予給分
    * OK