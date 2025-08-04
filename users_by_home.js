// جلب المستخدمين حسب معرف البيت من Supabase
async function fetchUsersByHome(houseId) {
    const apiKey = window.SUPABASE_ANON_KEY;
    const url = `https://akvyhsmobalbqfcjupdq.supabase.co/rest/v1/users?home_id=eq.${encodeURIComponent(houseId)}`;
    const res = await fetch(url, {
        headers: {
            apikey: apiKey,
            Authorization: `Bearer ${apiKey}`,
            'Content-Type': 'application/json'
        }
    });
    if (!res.ok) {
        return { status: 'error', message: 'خطأ في الاتصال' };
    }
    const data = await res.json();
    const users = data.map(u => ({ id: u.id, name: u.name }));
    return { status: 'success', users };
}
