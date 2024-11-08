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