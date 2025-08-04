// التحقق من وجود اسم البيت في قاعدة البيانات Supabase
async function checkHouse(houseName) {
    const apiKey = window.SUPABASE_ANON_KEY;
    const url = `https://akvyhsmobalbqfcjupdq.supabase.co/rest/v1/homes?name=eq.${encodeURIComponent(houseName)}`;
    const res = await fetch(url, {
        headers: {
            apikey: apiKey,
            Authorization: `Bearer ${apiKey}`,
            'Content-Type': 'application/json'
        }
    });
    if (!res.ok) {
        return { status: 'error', message: 'حدث خطأ في الاتصال' };
    }
    const data = await res.json();
    if (Array.isArray(data) && data.length > 0) {
        return {
            status: 'success',
            houseId: data[0].id,
            message: 'البيت موجود!'
        };
    } else {
        return { status: 'error', message: 'البيت غير موجود' };
    }
}
