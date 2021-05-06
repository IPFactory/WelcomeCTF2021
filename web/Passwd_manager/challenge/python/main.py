import requests
import os

from flask import *

app = Flask(__name__)

@app.route("/")
def index():
    css = request.args.get("css")

    user = request.cookies.get('user', None)
    passwd = request.cookies.get('passwd', None)

    return render_template("index.html", css=css, user="" if user == None else user , passwd="" if passwd == None else passwd)

@app.route("/update", methods=["POST"])
def update():
    user = request.form["user"]
    passwd = request.form["passwd"]
    
    res = make_response("<script>history.back();</script>")
    res.set_cookie("user", user)
    res.set_cookie("passwd", passwd)

    return res

@app.route("/worker", methods=["POST"])
def worker():
    if request.method == 'POST':
        css = request.form["css"]
        if len(css) > 500:
            return render_template('report.html', msg='文字列が長すぎます。')
        if css :
            res = requests.get(os.environ['NODE'] + '?css=' + css)
            return render_template('report.html', msg=res.json()['msg'])
        else:
            return redirect('/')

app.run(host='0.0.0.0')