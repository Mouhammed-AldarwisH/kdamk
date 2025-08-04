// دالة جلب بيانات المستخدمين حسب houseId من Supabase مباشرة

// ملاحظة: إذا كانت بياناتك غير حساسة يمكنك استخدام هذا الكود مباشرة في المتصفح

const SUPABASE_URL = 'https://akvyhsmobalbqfcjupdq.supabase.co/rest/v1/users';
const SUPABASE_API_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImFrdnloc21vYmFsYnFmY2p1cGRxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTE4OTc4MzksImV4cCI6MjA2NzQ3MzgzOX0.aYKPcM2sPZLsVmQLOvsI454RSVlIzNMK24sv_QHHErQ';

// جلب جميع المستخدمين المرتبطين ببيت معين
async function fetchUsersByHome(houseId) {
    try {
        const response = await fetch(`${SUPABASE_URL}?house_id=eq.${encodeURIComponent(houseId)}`, {
            headers: {
                'apikey': SUPABASE_API_KEY,
                'Authorization': `Bearer ${SUPABASE_API_KEY}`,
                'Content-Type': 'application/json'
            }
        });
        if (!response.ok) {
            return { status: 'error', message: 'خطأ في جلب المستخدمين' };
        }
        const users = await response.json();
        return { status: 'success', users };
    } catch (error) {
        return { status: 'error', message: 'خطأ في الاتصال', error: error.message };
    }
}

// جلب بيانات مستخدم واحد حسب userId
async function fetchUserById(userId) {
    try {
        const response = await fetch(`${SUPABASE_URL}?id=eq.${encodeURIComponent(userId)}`, {
            headers: {
                'apikey': SUPABASE_API_KEY,
                'Authorization': `Bearer ${SUPABASE_API_KEY}`,
                'Content-Type': 'application/json'
            }
        });
        if (!response.ok) {
            return { status: 'error', message: 'خطأ في جلب بيانات المستخدم' };
        }
        const data = await response.json();
        if (data && data.length > 0) {
            return { status: 'success', user: data[0] };
        } else {
            return { status: 'error', message: 'المستخدم غير موجود' };
        }
    } catch (error) {
        return { status: 'error', message: 'خطأ في الاتصال', error: error.message };
    }
}

// اجعل الدوال متاحة على window
window.fetchUsersByHome = fetchUsersByHome;
window.fetchUserById = fetchUserById;
