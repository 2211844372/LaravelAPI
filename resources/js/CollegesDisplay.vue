<template>
  <div class="main-wrapper">
    <header>
      <div class="logo">
<img :src="'/assets/logo.png'" alt="جامعة طرابلس" />      </div>
      <div class="title">
        <h1>نظام إدارة الكليات</h1>
      </div>
      <div class="icons">
        <a href="/" title="الرئيسية"><i class="fas fa-home"></i></a>
        <a href="/manage" title="إدارة الكليات"><i class="fas fa-university"></i></a>
      </div>
    </header>

    <div class="container">
      <div class="page-header">
        <h3><i class="fas fa-th-large"></i> الكليات المسجلة </h3>
        <a href="#" class="btn-add">
          <i class="fas fa-plus-circle"></i> إضافة كلية جديدة
        </a>
      </div>

      <div v-if="loading" class="text-center">
        <p>جاري جلب البيانات من الـ API...</p>
      </div>

      <div v-else class="cards-grid">
        <div v-for="college in colleges" :key="college.id" class="college-card">
          <div class="card-content">
            <i :class="college.icon || 'fas fa-university'"></i>

            <h4>{{ college.name }}</h4>

            <p><strong><i class="fas fa-calendar-alt"></i> التأسيس:</strong> {{ college.founded_year || 'غير مسجل' }}</p>
            <p><strong><i class="fas fa-user-tie"></i> العميد:</strong> {{ college.dean_name || 'غير مسجل' }}</p>
            <p style="margin-top: 10px;">{{ college.description }}</p>
          </div>

          <div class="card-actions">
            <button class="btn-icon btn-edit" title="تعديل"><i class="fas fa-edit"></i></button>
            <button class="btn-icon btn-delete" @click="deleteConfirm(college.id)" title="حذف"><i class="fas fa-trash"></i></button>
          </div>
        </div>

        <div v-if="colleges.length === 0" class="empty-msg">
          <i class="fas fa-folder-open" style="font-size: 50px; margin-bottom: 15px;"></i>
          <p>لا توجد كليات مضافة حالياً في قاعدة البيانات.</p>
          <p><small>تأكدي من تشغيل السيرفر والـ API</small></p>
        </div>
      </div>
    </div>

    <footer>
      &copy; 2025 جامعة طرابلس - جميع الحقوق محفوظة
    </footer>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'CollegesDisplay',
  data() {
    return {
      colleges: [], // المصفوفة اللي حتتعبى من الـ API
      loading: true,
    }
  },
  mounted() {
    this.fetchColleges();
  },
  methods: {
    async fetchColleges() {
      try {
        // جربي بالرابط امتاعك توا، ويوم التسليم حطي رابط صاحبتك هنا
        const response = await axios.get('http://127.0.0.1:8000/api/colleges');
        this.colleges = response.data;
      } catch (error) {
        console.error("حدث خطأ أثناء جلب البيانات:", error);
      } finally {
        this.loading = false;
      }
    },
    deleteConfirm(id) {
      if(confirm('هل أنتِ متأكدة من حذف هذه الكلية؟')) {
        console.log('سيتم إرسال طلب حذف للـ API للكلية رقم: ' + id);
      }
    }
  }
}
</script>

<style scoped>
/* التنسيقات امتاعك اللي بعتيها مع تعديلات بسيطة للـ Vue */
:root {
    --primary-color: #1B5E20;
    --secondary-color: #4CAF50;
    --accent-color: #F9A825;
    --bg-color: #f4f7f6;
}

.main-wrapper { 
    background: #f4f7f6; 
    min-height: 100vh;
    direction: rtl;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

header {
    display: grid; 
    grid-template-columns: auto 1fr auto; 
    align-items: center;
    padding: 10px 50px; 
    background: white;
    border-bottom: 3px solid #4CAF50;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

.logo img { height: 70px; }
.title h1 { margin: 0; font-size: 24px; color: #1B5E20; text-align: center; }

.icons a { text-decoration: none; margin-right: 20px; font-size: 20px; color: #666; transition: 0.3s; }
.icons a:hover { color: #4CAF50; }

.container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.btn-add {
    background: #4CAF50;
    color: white;
    padding: 12px 25px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
}

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
    border-top: 5px solid #4CAF50;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.college-card:hover { transform: translateY(-10px); }

.card-content { padding: 25px; text-align: right; }
.card-content i { font-size: 40px; color: #F9A825; margin-bottom: 15px; display: block; }
.card-content h4 { margin: 0 0 10px 0; font-size: 20px; color: #1B5E20; }
.card-content p { color: #555; font-size: 14px; margin: 5px 0; line-height: 1.6; }

.card-actions {
    background: #f9f9f9;
    padding: 15px 25px;
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    border-top: 1px solid #eee;
}

.btn-icon { background: none; border: none; cursor: pointer; font-size: 18px; }
.btn-edit { color: #1E88E5; }
.btn-delete { color: #e53935; }

.empty-msg {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px;
    background: white;
    border-radius: 15px;
    color: #888;
    border: 2px dashed #ccc;
}

footer { text-align: center; padding: 40px; color: #aaa; font-size: 13px; }

.text-center { text-align: center; padding: 50px; }
</style>