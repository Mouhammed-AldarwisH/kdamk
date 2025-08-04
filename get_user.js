// This file is now a JavaScript file (Node.js/Express style)

const express = require('express');
const fetch = require('node-fetch');
const app = express();

app.use(express.json());

app.post('/get_user', async (req, res) => {
    const userId = req.body.userId;
    if (!userId) {
        return res.json({ status: 'error', message: 'لم يتم إرسال معرف المستخدم' });
    }

    const url = `https://akvyhsmobalbqfcjupdq.supabase.co/rest/v1/users?id=eq.${encodeURIComponent(userId)}`;
    const apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImFrdnloc21vYmFsYnFmY2p1cGRxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTE4OTc4MzksImV4cCI6MjA2NzQ3MzgzOX0.aYKPcM2sPZLsVmQLOvsI454RSVlIzNMK24sv_QHHErQ';

    try {
        const response = await fetch(url, {
            headers: {
                'apikey': apiKey,
                'Authorization': `Bearer ${apiKey}`,
                'Content-Type': 'application/json'
            }
        });

        if (response.status === 200) {
            const data = await response.json();
            if (data && data.length > 0) {
                const user = {
                    id: data[0].id,
                    name: data[0].name,
                    role: data[0].role
                };
                return res.json({ status: 'success', user });
            } else {
                return res.json({ status: 'error', message: 'المستخدم غير موجود' });
            }
        } else {
            return res.json({ status: 'error', message: 'خطأ في الاتصال' });
        }
    } catch (error) {
        return res.json({ status: 'error', message: 'حدث خطأ أثناء الاتصال', error: error.message });
    }
});

// To run this file, save it as get_user.js and run with Node.js after installing express and node-fetch
// Example: npm install express node-fetch
// Then: node get_user.js

// Uncomment below to run as standalone server
// const PORT = process.env.PORT || 3000;
// app.listen(PORT, () => console.log(`Server running on port ${PORT}`));