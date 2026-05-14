<?php
$plans = [
    ["amount" => 100, "months" => 3],
    ["amount" => 200, "months" => 3],
    ["amount" => 300, "months" => 3],
    ["amount" => 500, "months" => 5],
    ["amount" => 1000, "months" => 10],
];

$whatsappNumber = "966500000000";
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقسيط بطاقات سوا | طلب سريع عبر واتساب</title>
    <meta name="description" content="خدمة تقسيط بطاقات سوا بأسعار واضحة وأقساط شهرية سهلة مع طلب مباشر عبر واتساب.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="hero">
        <div class="hero__overlay"></div>
        <div class="container">
            <nav class="topbar">
                <div class="brand">
                    <span class="brand__logo" aria-hidden="true">S</span>
                    <div>
                        <h1>تقسيط بطاقات سوا</h1>
                        <p>حل سريع.. أقساط مريحة.. وخدمة موثوقة</p>
                    </div>
                </div>
                <a class="topbar__cta" href="#plans">اختر باقتك الآن</a>
            </nav>

            <section class="hero__content">
                <h2>اشحن رصيدك اليوم وادفع على دفعات شهرية ثابتة</h2>
                <p>
                    نقدم لك خيارات تقسيط مرنة لبطاقات سوا مع توضيح كامل للمبلغ والمدة والقسط الشهري.
                    اختر الخطة المناسبة واطلب فوراً عبر واتساب.
                </p>
                <a class="hero__button" href="#plans">ابدأ الطلب خلال دقيقة</a>
            </section>
        </div>
    </header>

    <main class="container">
        <section id="plans" class="plans">
            <div class="section-title">
                <h3>الباقات المتاحة للتقسيط</h3>
                <p>أمثلة واقعية بأسعار واضحة وبدون تعقيد</p>
            </div>

            <div class="cards">
                <?php foreach ($plans as $plan): ?>
                    <?php
                        $monthly = number_format($plan["amount"] / $plan["months"], 2);
                        $message = "السلام عليكم، أرغب في طلب تقسيط بطاقة سوا بقيمة {$plan["amount"]} ريال لمدة {$plan["months"]} أشهر، القسط الشهري {$monthly} ريال.";
                        $waLink = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);
                    ?>
                    <article class="card">
                        <div class="card__badge">الأكثر طلباً</div>
                        <h4>بطاقة <?php echo $plan["amount"]; ?> ريال</h4>
                        <ul>
                            <li><span>المدة</span><strong><?php echo $plan["months"]; ?> أشهر</strong></li>
                            <li><span>القسط الشهري</span><strong><?php echo $monthly; ?> ريال</strong></li>
                            <li><span>إجمالي المبلغ</span><strong><?php echo number_format($plan["amount"], 2); ?> ريال</strong></li>
                        </ul>
                        <a class="whatsapp-btn" href="<?php echo $waLink; ?>" target="_blank" rel="noopener noreferrer">
                            اطلب عبر واتساب
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="marketing">
            <p>✔ موافقة سريعة</p>
            <p>✔ أقساط شهرية واضحة</p>
            <p>✔ دعم متواصل وخدمة محترفة</p>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer__content">
            <p>للتواصل: واتساب <a href="https://wa.me/<?php echo $whatsappNumber; ?>" target="_blank" rel="noopener noreferrer"><?php echo $whatsappNumber; ?></a></p>
            <p>جميع الحقوق محفوظة © خدمة تقسيط بطاقات سوا</p>
        </div>
    </footer>
</body>
</html>