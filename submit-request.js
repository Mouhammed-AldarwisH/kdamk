// إرسال الطلب إلى Supabase عبر جافاسكريبت
async function submitRequest({ sender_id, receiver_id, item_ids, location_id, home_id }) {
    const apiKey = window.SUPABASE_ANON_KEY;
    const url = "https://akvyhsmobalbqfcjupdq.supabase.co/rest/v1/requests";
    const data = [{
        sender_id: Number(sender_id),
        receiver_id: Number(receiver_id),
        item_ids,
        location_id: Number(location_id),
        home_id: Number(home_id)
    }];
    const res = await fetch(url, {
        method: "POST",
        headers: {
            apikey: apiKey,
            Authorization: apiKey,
            "Content-Type": "application/json",
            Prefer: "return=representation"
        },
        body: JSON.stringify(data)
    });
    if (!res.ok) {
        const err = await res.json();
        throw new Error(err.error?.message || "خطأ في إرسال الطلب");
    }
    return await res.json();
}
