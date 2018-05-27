SELECT *, count(*) AS x,
count(IF (gender='m', 1, NULL)) as m,
count(IF (gender='w', 1, NULL)) as w
FROM users
GROUP BY group_id
HAVING w > m