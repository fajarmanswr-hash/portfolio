<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بقالة التوفير</title>
    <style>
        :root { --main-green: #2ecc71; --dark-blue: #34495e; --bg-gray: #f8f9fa; }
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: var(--bg-gray); margin: 0; padding: 0; direction: rtl; }
        
        .top-banner { background-color: var(--main-green); color: white; padding: 40px 20px; text-align: center; border-bottom-left-radius: 30px; border-bottom-right-radius: 30px; margin-bottom: 20px; }
        .top-banner h1 { margin: 0; font-size: 28px; }

        .categories-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; padding: 0 15px; margin-bottom: 25px; }
        .cat-card { background: white; border: none; border-radius: 15px; padding: 15px 5px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); cursor: pointer; display: flex; flex-direction: column; align-items: center; transition: 0.2s; }
        .cat-card:active { transform: scale(0.9); background: #eee; }
        .cat-card span.emoji { font-size: 24px; margin-bottom: 8px; }
        .cat-card span.label { color: #2980b9; font-weight: bold; font-size: 13px; }

        .items-container { background: white; margin: 15px; border-radius: 20px; overflow: hidden; display: none; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .cat-header { background: var(--main-green); color: white; padding: 15px; text-align: center; font-weight: bold; position: relative; }
        .close-btn { position: absolute; left: 15px; top: 12px; background: rgba(0,0,0,0.2); border: none; color: white; border-radius: 50%; width: 25px; height: 25px; cursor: pointer; }
        
        .product-row { display: flex; justify-content: space-between; align-items: center; padding: 15px; border-bottom: 1px solid #eee; }
        .p-name { font-weight: bold; color: #333; }
        .p-price { color: var(--main-green); font-size: 13px; }
        
        .controls { display: flex; align-items: center; gap: 15px; }
        .btn-round { width: 35px; height: 35px; border-radius: 50%; border: none; color: white; font-size: 20px; font-weight: bold; cursor: pointer; }
        .plus { background-color: #2ecc71; }
        .minus { background-color: #e74c3c; }

        .manual-box { background: #fffde7; padding: 20px; text-align: center; border-top: 2px solid #f1c40f; }
        .manual-box input { width: 42%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; margin: 3px; box-sizing: border-box; }
        .add-btn { background: #f1c40f; border: none; padding: 12px; border-radius: 8px; font-weight: bold; width: 90%; margin-top: 10px; cursor: pointer; }

        .cart-section { background: white; margin: 15px; border-radius: 25px; padding: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        .total-display { background: var(--dark-blue); color: white; padding: 18px; border-radius: 15px; text-align: center; font-size: 22px; font-weight: bold; margin: 15px 0; }
        .user-input { width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #ddd; margin-bottom: 15px; box-sizing: border-box; font-size: 16px; }
        .send-btn { background: #25D366; color: white; border: none; width: 100%; padding: 20px; border-radius: 15px; font-size: 20px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; }
    </style>
</head>
<body>

    <div class="top-banner">
        <h1>بقالة التوفير 🛒</h1>
        <p>كل اللي ببالك.. متوفر عندنا</p>
    </div>

    <div class="categories-grid">
        <button class="cat-card" onclick="showCat('غازيات')"><span>🥤</span><span class="label">غازيات</span></button>
        <button class="cat-card" onclick="showCat('شبسات')"><span>🍟</span><span class="label">شبسات</span></button>
        <button class="cat-card" onclick="showCat('حلويات')"><span>🍫</span><span class="label">حلويات</span></button>
        <button class="cat-card" onclick="showCat('حليب وألبان')"><span>🍶</span><span class="label">حليب وألبان</span></button>
        <button class="cat-card" onclick="showCat('عصيرات')"><span>🧃</span><span class="label">عصيرات</span></button>
        <button class="cat-card" onclick="showCat('منزل')"><span>🏠</span><span class="label">منزل</span></button>
        <button class="cat-card" onclick="showCat('منظفات')"><span>🧼</span><span class="label">منظفات</span></button>
        <button class="cat-card" onclick="showCat('فطاير')"><span>🍕</span><span class="label">فطاير</span></button>
    </div>

    <div id="itemsBox" class="items-container"></div>

    <div class="cart-section">
        <h3>📋 سلتك الحالية:</h3>
        <div id="cartList"><p style="text-align:center; color:#999;">لم تضف شيئاً بعد</p></div>
        <div class="total-display" id="totalPrice">المجموع: 0 ريال</div>
        <input type="text" id="userName" class="user-input" placeholder="👤 اسمك الكريم">
        <button class="send-btn" onclick="sendOrder()">إرسال الطلب واتساب ✅</button>
    </div>

    <script>
        const products = {
            'غازيات': [{name: "بيبسي", price: 2.5}, {name: "سفن اب", price: 2.5}],
            'شبسات': [{name: "ليز ملح", price: 5}, {name: "دوريتوس", price: 5}],
            'حلويات': [{name: "جلكسي", price: 4.5}, {name: "كتكات", price: 3}],
            'حليب وألبان': [{name: "لبن نادك", price: 8.5}, {name: "حليب طازج", price: 8}],
            'عصيرات': [{name: "عصير ربيع", price: 1.5}, {name: "سيزر", price: 4}],
            'منزل': [{name: "أرز 5 كيلو", price: 45}, {name: "سكر 5 كيلو", price: 25}],
            'منظفات': [{name: "كلوركس", price: 14}, {name: "فلاش", price: 10}],
            'فطاير': [{name: "بيتزا", price: 5}, {name: "فطيرة جبن", price: 1.5}]
        };

        let cart = {};

        function showCat(cat) {
            const box = document.getElementById('itemsBox');
            box.style.display = "block";
            let html = `<div class="cat-header"><button class="close-btn" onclick="document.getElementById('itemsBox').style.display='none'">✕</button>${cat}</div>`;
            
            products[cat].forEach(p => {
                let q = cart[p.name] ? cart[p.name].qty : 0;
                html += `
                    <div class="product-row">
                        <div><div class="p-name">${p.name}</div><div class="p-price">${p.price} ريال</div></div>
                        <div class="controls">
                            <button class="btn-round minus" onclick="update('${p.name}',${p.price},-1)">-</button>
                            <span id="q-${p.name}">${q}</span>
                            <button class="btn-round plus" onclick="update('${p.name}',${p.price},1)">+</button>
                        </div>
                    </div>`;
            });
            html += `
                <div class="manual-box">
                    <p style="font-size:12px; font-weight:bold; color:#856404; margin-bottom:10px;">أضف منتج غير موجود:</p>
                    <input type="text" id="m-n" placeholder="اسم المنتج">
                    <input type="number" id="m-p" placeholder="السعر">
                    <button class="add-btn" onclick="addM()">إضافة للسلة +</button>
                </div>`;
            box.innerHTML = html;
            window.scrollTo({ top: box.offsetTop - 20, behavior: 'smooth' });
        }

        function addM() {
            let n = document.getElementById('m-n').value;
            let p = parseFloat(document.getElementById('m-p').value);
            if(n && p) { update(n, p, 1); document.getElementById('m-n').value=''; document.getElementById('m-p').value=''; }
            else { alert("أدخل الاسم والسعر"); }
        }

        function update(name, price, delta) {
            if(!cart[name]) cart[name] = {price: price, qty: 0};
            cart[name].qty += delta;
            if(cart[name].qty <= 0) delete cart[name];
            if(document.getElementById('q-'+name)) document.getElementById('q-'+name).innerText = cart[name] ? cart[name].qty : 0;
            render();
        }

        function render() {
            const list = document.getElementById('cartList');
            let total = 0; list.innerHTML = "";
            let keys = Object.keys(cart);
            if(keys.length === 0) list.innerHTML = '<p style="text-align:center; color:#999;">لم تضف شيئاً بعد</p>';
            keys.forEach(k => {
                total += (cart[k].price * cart[k].qty);
                list.innerHTML += `<div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #eee;">
                    <span>📍 ${k} (×${cart[k].qty})</span><b>${(cart[k].price * cart[k].qty).toFixed(1)} ريال</b>
                </div>`;
            });
            document.getElementById('totalPrice').innerText = "المجموع: " + total.toFixed(1) + " ريال";
        }

        function sendOrder() {
            let n = document.getElementById('userName').value;
            if(!n || Object.keys(cart).length === 0) { alert("يرجى كتابة اسمك وإضافة منتجات"); return; }
            let s = Object.keys(cart).map(k => `• ${k} (×${cart[k].qty})`).join("%0A");
            let totalTxt = document.getElementById('totalPrice').innerText;
            
            // الرابط المباشر للواتساب
            let whatsappUrl = `https://api.whatsapp.com/send?phone=966557977220&text=*طلب جديد*%0A👤 الاسم: ${n}%0A🛒 الطلبات:%0A${s}%0A💰 ${totalTxt}`;
            
            window.location.href = whatsappUrl;
        }
    </script>
</body>
</html>
