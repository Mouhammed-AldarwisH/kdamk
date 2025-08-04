// لم يعد هناك حاجة لهذا الملف بعد نقل الكود إلى index.js
function checkHouse(event) {
    event.preventDefault();
    const houseName = document.getElementById('houseName').value.trim();
    const resultDiv = document.getElementById('result-message');
    if (houseName === "test_house") {
        // حفظ اسم البيت في localStorage أو أي متغير مطلوب
        localStorage.setItem('houseName', houseName);
        resultDiv.textContent = "تم التحقق بنجاح";
        resultDiv.style.color = "green";
        // يمكنك إعادة التوجيه أو إظهار خيارات المستخدمين هنا
    } else {
        resultDiv.textContent = "اسم البيت غير صحيح";
        resultDiv.style.color = "red";
    }
}
