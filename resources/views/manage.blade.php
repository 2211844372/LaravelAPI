<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جامعة طرابلس | إدارة الكليات</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1B5E20;
            --secondary-color: #4CAF50;
            --accent-color: #F9A825;
            --bg-color: #f4f7f6;
        }

        body { 
            margin: 0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: var(--bg-color); 
            color: #333; 
        }

        /* HEADER */
        header {
            display: grid; 
            grid-template-columns: auto 1fr auto; 
            align-items: center;
            padding: 10px 50px; 
            background: white;
            border-bottom: 3px solid var(--secondary-color);
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        .logo img { height: 70px; }
        .title h1 { margin: 0; font-size: 24px; color: var(--primary-color); text-align: center; }

        .icons a { text-decoration: none; margin-left: 20px; font-size: 20px; color: #666; transition: 0.3s; }
        .icons a:hover { color: var(--secondary-color); transform: translateY(-3px); }

        /* MAIN CONTAINER */
        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }

        /* TOP SECTION (Title + Add Button) */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn-add {
            background: var(--secondary-color);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
            transition: 0.3s;
        }
        .btn-add:hover { background: var(--primary-color); transform: scale(1.05); }

        /* CARDS GRID */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .college-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: 0.3s;
            border-top: 5px solid var(--secondary-color);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .college-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }

        .card-content { padding: 25px; }
        .card-content i { font-size: 40px; color: var(--accent-color); margin-bottom: 15px; display: block; }
        .card-content h4 { margin: 0 0 10px 0; font-size: 20px; color: var(--primary-color); }
        .card-content p { color: #555; font-size: 14px; margin: 5px 0; line-height: 1.6; }

        .card-actions {
            background: #f9f9f9;
            padding: 15px 25px;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            border-top: 1px solid #eee;
        }
        .btn-icon { background: none; border: none; cursor: pointer; font-size: 18px; transition: 0.2s; }
        .btn-edit { color: #1E88E5; }
        .btn-delete { color: #e53935; }
        .btn-icon:hover { transform: scale(1.2); }

        /* Empty State */
        .empty-msg {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px;
            background: white;
            border-radius: 15px;
            color: #888;
            border: 2px dashed #ccc;
        }
    </style>
</head>
<body>

<header>
    <div class="logo"><img src="{{ asset('assets/logo.png') }}" alt="جامعة طرابلس"></div>
    <div class="title"><h1>نظام إدارة الكليات</h1></div>
    <div class="icons">
        <a href="/" title="الرئيسية"><i class="fas fa-home"></i></a>
        <a href="/manage" title="إدارة الكليات"><i class="fas fa-university"></i></a>
    </div>
</header>

<div class="container">
    <div class="page-header">
        <h3><i class="fas fa-th-large"></i> الكليات المسجلة</h3>
        <a href="#" class="btn-add">
            <i class="fas fa-plus-circle"></i> إضافة كلية جديدة
        </a>
    </div>

    <div class="cards-grid">
        {{-- هنا يبدأ الربط الحقيقي مع قاعدة البيانات --}}
        @forelse($colleges as $college)
            <div class="college-card">
                <div class="card-content">
                    {{-- عرض الأيقونة المخزنة (لو مفيش يحط أيقونة افتراضية) --}}
                    <i class="{{ $college->icon ?? 'fas fa-university' }}"></i>
                    
                    <h4>{{ $college->name }}</h4>
                    
                    <p><strong><i class="fas fa-calendar-alt"></i> التأسيس:</strong> {{ $college->founded_year ?? 'غير مسجل' }}</p>
                    <p><strong><i class="fas fa-user-tie"></i> العميد:</strong> {{ $college->dean_name ?? 'غير مسجل' }}</p>
                    <p style="margin-top: 10px;">{{ $college->description }}</p>
                </div>
                
                <div class="card-actions">
                    <button class="btn-icon btn-edit" title="تعديل"><i class="fas fa-edit"></i></button>
                    <button class="btn-icon btn-delete" title="حذف"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        @empty
            {{-- تظهر هذه الرسالة فقط إذا كان جدول الكليات فارغاً --}}
            <div class="empty-msg">
                <i class="fas fa-folder-open" style="font-size: 50px; margin-bottom: 15px;"></i>
                <p>لا توجد كليات مضافة حالياً في قاعدة البيانات.</p>
                <p><small>استخدم زر "إضافة كلية" بالأعلى للبدء.</small></p>
            </div>
        @endforelse
    </div>
</div>

<footer style="text-align: center; padding: 40px; color: #aaa; font-size: 13px;">
    &copy; 2025 جامعة طرابلس - جميع الحقوق محفوظة
</footer>

</body>
</html>