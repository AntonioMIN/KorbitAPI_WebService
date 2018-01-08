<div class="ui middle aligned center aligned grid" style="height:100%;">
    <div class="column" style="max-width:450px;">
        <h1 class="ui header">
            <div class="content">
                MyBitCoin
            </div>
        </h1>
        <form class="ui large form" action="/auth" method="post" class="ui form">
            <div class="ui stacked segment">
                <div class="field">
                    <label>Email</label>
                    <input type="email" name="username">
                </div>
                <div class="field">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <input class="ui primary button" type="submit" value="Login">
            </div>
        </form>
        <div class="ui floating message">
            <p>Korbit 계정이 필요합니다. <a href="https://korbit.co.kr">Korbit</a></p>
            <p>본 서비스는 어떠한 사용자 정보를 저장하지 않는 DB Serverless 서비스입니다.</p>
            <br>
            <p>Created by <a href="https://antoniomin.github.io">Antonio Min</a>(gvvvv1123@gmail.com)</p>
        </div>
    </div>
</div>