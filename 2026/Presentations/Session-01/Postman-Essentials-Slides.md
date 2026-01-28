# 🎞️ SaaS‑2‑BED – Session 01 (Supplement)
## Postman Essentials for REST API Testing

---

# 🟦 slide
# **What is Postman?**

- Send requests, inspect responses
- Organise with Collections
- Use variables & environments
- Automate checks with Tests

---

# 🟦 slide
# **Installing & Opening Postman**

Download: https://www.postman.com/downloads/

[ screenshot placeholder ]

---

# 🟦 slide
# **Importing a Collection**

1. Click **Import**
2. Upload the JSON file

[ screenshot placeholder ]

---

# 🟦 slide
# **Setting Up Variables**

Use collection variables:
`base_url = http://127.0.0.1:8000`

[ screenshot placeholder ]

---

# 🟦 slide
# **Using Environments**

Create an environment and set `base_url`.

[ screenshot placeholder ]

---

# 🟦 slide
# **Running Requests**

Test `GET /courses`.

[ screenshot placeholder ]

---

# 🟦 slide
# **POST Requests**

Example JSON body:
```json
{"code":"BED101","title":"Backend Basics"}
```

[ screenshot placeholder ]

---

# 🟦 slide
# **Tests**

```javascript
pm.test("Status is 201", ()=> pm.response.to.have.status(201));
pm.test("Has Location header", ()=> pm.response.headers.has("Location"));
```

---

# 🟦 slide
# **Saving Examples**

Use **Save Response → Save as Example**.

---

# 🟦 slide
# **Exporting Collections**

Use: **⋮ → Export → Collection v2.1**

---

# 🟦 slide
# **Further Study**

- https://learning.postman.com/
- https://laravel.com/docs/
- https://pestphp.com/

