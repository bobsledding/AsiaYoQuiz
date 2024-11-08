# AsiaYoQuiz
 AsiaYo_亞洲遊 面試前測驗

## 題目一
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

## 題目二
 Q: 在題目一的執行下，我們發現 SQL 執行速度很慢，您會怎麼去優化？請闡述您怎麼判斷與優化的方式

 A: 我通常先下 `EXPLAIN` 去看, 看哪段步驟所需要查詢的資料量最多, 雖然我並未真的針對此題去建DB, 但根據經驗, 查 `created_at` 或 `currency` 欄位時會查詢整張表, 效能自然差. 所以我遇到這種狀況可能至少建 `created_at` 的 index, 或是 `created_at + currency` 的 index, 視情況而定.

 nit: `orders`表疑似有多餘的資料(欄位`bnb_id`), 其功能完全可被 `room_id` 取代, 有可能造成資料不一致, 若確認過busisness logic後確定用不到則應刪除