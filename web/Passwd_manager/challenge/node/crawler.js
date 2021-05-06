const express = require('express');
const createError = require('http-errors');
const puppeteer = require('puppeteer');
const fs = require('fs')

const app = express();
const host = process.env.PYTHON;

const router = express.Router();
router.get('/', async function (req, res, next) {
    const css = req.query.css;
    if (css) {
        const browser = await puppeteer.launch({
            args: [
                '--no-sandbox',
                '--disable-popup-blocking',
            ],
            headless: true,
        });
        const page = await browser.newPage();

        const cookies = JSON.parse(fs.readFileSync('cookies.json', 'utf-8'));
        for (let cookie of cookies) {
            await page.setCookie(cookie);
        }
        const url = host + "?css=" + css

        page.goto(url).then(() => {
            res.header('Access-Control-Allow-Origin', '*');
            res.send({ msg: 'すぐに見に行くから待っててね！' });
        }).catch((err) => {
            res.header('Access-Control-Allow-Origin', '*');
            res.send({ msg: 'something went wrong' });
        });
        setTimeout(() => {
            browser.close()
        }, 60 * 1000)
        return
    }
    res.header('Access-Control-Allow-Origin', '*');
    res.send({ msg: 'css is empty' });
});
app.use("/", router);

// catch 404 and forward to error handler
app.use(function (req, res, next) {
    next(createError(404));
});

// error handler
app.use(function (err, req, res, next) {
    res.status(err.status || 500);
    res.send('error');
});

app.listen(3000, () => console.log('--- crawler in localhost:3000 ---'));