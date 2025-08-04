// التحقق من اسم البيت عبر جافاسكريبت (مثال: اسم البيت الصحيح هو "test_house")
function checkHouse1(event) {
    event.preventDefault();
    const houseName = document.getElementById('houseName').value.trim();
    const resultDiv = document.getElementById('result-message');
    if (houseName === "test_house") {
        localStorage.setItem('houseName', houseName);
        resultDiv.textContent = "تم التحقق بنجاح";
        resultDiv.style.color = "green";
        // يمكنك إعادة التوجيه أو إظهار خيارات المستخدمين هنا
    } else {
        resultDiv.textContent = "اسم البيت غير صحيح";
        resultDiv.style.color = "red";
    
    
    }

}
