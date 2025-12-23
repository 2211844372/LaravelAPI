<template>
  <div>
    <header>
      <div class="logo">
        <img :src="'/assets/logo.png'" alt="جامعة طرابلس">
      </div>

      <div class="title">
        <h1>جامعة طرابلس</h1>
        <h2>نظام إدارة الكليات</h2>
      </div>

      <div class="icons">
        <a href="/" title="الرئيسية"><i class="fas fa-home"></i></a>
        <a href="/manage" title="إدارة الكليات"><i class="fas fa-university"></i></a>
        <a href="#" title="إضافة كلية"><i class="fas fa-plus-circle"></i></a>
      </div>
    </header>

    <div class="container">
      <div class="about">
        <h3>عن جامعة طرابلس</h3>
        <p>
          تُعد جامعة طرابلس واحدة من أقدم وأكبر الجامعات في ليبيا، حيث تأسست سنة 
          <strong>1957</strong>، وتضم عددًا كبيرًا من الكليات العلمية والإنسانية.
        </p>
        <p>
          يهدف <strong>نظام إدارة الكليات</strong> إلى تنظيم بيانات الكليات وتسهيل إدارتها، ودعم عملية اتخاذ القرار.
        </p>
      </div>

      <div class="stats">
        <div class="stat-card">
          <i class="fas fa-school"></i>
          <h4>عدد الكليات</h4>
          <p>{{ collegeCount }}</p> 
        </div>

        <div class="stat-card">
          <i class="fas fa-users"></i>
          <h4>عدد الموظفين</h4>
          <p>350</p>
        </div>
      </div>

      <div class="map">
        <h3>موقع جامعة طرابلس</h3>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3350.609653245453!2d13.2201!3d32.8681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13a893259e21184d%3A0x644c1d636b008d!2sUniversity%20of%20Tripoli!5e0!3m2!1sen!2sly!4v1700000000000"
            width="100%"
            height="350"
            style="border:0; border-radius:12px;"
            loading="lazy">
        </iframe>
      </div>
    </div>

    <footer>
      © 2025 جامعة طرابلس – DevUp Team
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const collegeCount = ref(0);

const loadStats = async () => {
  try {
    // هادي وظيفتها بس تجيب عدد الكليات عشان ينعرض في الكارت فوق
    const response = await axios.get('/api/colleges');
    collegeCount.value = response.data.length;
  } catch (error) {
    console.error("فشل جلب الإحصائيات:", error);
  }
};

onMounted(loadStats);
</script>

<style>
body {
    margin: 0;
    font-family: Tahoma, Arial, sans-serif;
    direction: rtl;
    background: linear-gradient(135deg, #fdfcfb, #e8f5e9);
    color: #333;
}

header {
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    padding: 15px 40px;
    background: linear-gradient(90deg, #ffffff, #f1f8e9);
    border-bottom: 4px solid #4CAF50;
    box-shadow: 0 3px 10px rgba(0,0,0,0.12);
}

.logo img { height: 85px; background: #fff; padding: 5px; border-radius: 10px; }
.title h1 { margin: 0; color: #1B5E20; font-size: 28px; text-align: center; }
.title h2 { margin: 5px 0 0; color: #F9A825; font-size: 18px; text-align: center; font-weight: normal; }

.icons a { margin-left: 18px; text-decoration: none; font-size: 22px; transition: 0.3s; }
.icons a:nth-child(1) { color: #1E88E5; }
.icons a:nth-child(2) { color: #43A047; }
.icons a:nth-child(3) { color: #FB8C00; }
.icons a:hover { transform: scale(1.2); }

.container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }

.about, .map { 
    background: #ffffff; padding: 30px; border-radius: 14px; 
    box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 30px;
}

.stats { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px; }

.stat-card { 
    background: #fff; padding: 20px; border-radius: 14px; text-align: center;
    box-shadow: 0 5px 12px rgba(0,0,0,0.1); border-top: 5px solid #4CAF50;
}

.stat-card i { font-size: 30px; color: #FBC02D; margin-bottom: 10px; }
.stat-card p { font-size: 28px; font-weight: bold; color: #1B5E20; margin: 5px 0; }

footer { text-align: center; padding: 20px; color: #777; }
</style>