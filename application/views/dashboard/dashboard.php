<script src="/static/dashboard.js"></script>
<div class="ui secondary pointing menu nav">
    <div class="header item">
        My Bitcoin
    </div>
    <a href="/dashboard" class="item active">
        Dashboard
    </a>
    <div class="right menu">
        <a href="/auth/logout" class="ui item">Logout</a>
    </div>
</div>
<div class="ui stackable grid container">
    <div class="row">
        <div class="ui segment" style="width:100%">
            <div class="ui grid">
                <div class="four column row">
                    <div class="left floated column"><h2 class="header">Wallet</h2></div>
                    <div class="right aligned floated column"><button class="ui icon button" onclick="get_balance();"><i class="refresh icon"></i></button></div>
                </div>
            </div>
            <div class="ui cards" id="wallet_container">
                <div class="ui active loader"></div>
                <p></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="ui segment" style="width:100%">
            <div class="ui grid">
                <div class="four column row">
                    <div class="left floated column"><h2>Ticker</h2></div>
                    <div class="right aligned floated column">
                        <div class="ui icon buttons">
                            <button class="ui button" onclick="ticker_play();">
                                <i class="play icon"></i>
                            </button>
                            <button class="ui button" onclick="ticker_pause();">
                                <i class="pause icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="ui pointing menu">
                <a id="menu_btc" class="active item" onclick="changeCurrency(0);">BTC</a>
                <a id="menu_bch" class="item" onclick="changeCurrency(1);">BCH</a>
                <a id="menu_eth" class="item" onclick="changeCurrency(2);">ETH</a>
                <a id="menu_xrp" class="item" onclick="changeCurrency(3);">XRP</a>
            </div>
            <div class="ui segment">
                <h3 id="ticker"></h3>
                <div class="ui stackable grid">
                    <div class="three column row">
                        <div class="column">
                            <h5>최근 체결 내역</h5>
                            <table class="ui selectable striped celled sortable table ticker-table">
                                <thead>
                                    <tr>
                                        <th>체결시각</th>
                                        <th>체결량</th>
                                        <th>체결가</th>
                                    </tr>
                                </thead>
                                <tbody id="transactions_container">
                                </tbody>
                            </table>
                        </div>
                        <div class="column">
                            <h5>현재 시세 - 매수</h5>
                            <table class="ui selectable striped celled table sortable ticker-table">
                                <thead>
                                    <tr>
                                        <th>수량</th>
                                        <th>매수호가</th>
                                    </tr>
                                </thead>
                                <tbody id="orderbook_bid">
                                </tbody>
                            </table>
                        </div>
                        <div class="column">
                            <h5>현재 시세 - 매도</h5>
                            <table class="ui selectable striped celled table sortable ticker-table">
                                <thead>
                                    <tr>
                                        <th>매도호가</th>
                                        <th>수량</th>
                                    </tr>
                                </thead>
                                <tbody id="orderbook_ask">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="ui segment" style="width:100%">
            <div class="ui grid">
                <div class="four column row">
                    <div class="left floated column"><h2>Order History</h2></div>
                    <div class="right aligned floated column"><button class="ui icon button" onclick="get_user_orders();"><i class="refresh icon"></i></button></div>
                </div>
            </div>
            <table class="ui selectable striped celled sortable table">
                <thead class="full-width">
                    <tr>
                        <th>주문</th>
                        <th>체결시각</th>
                        <th>주문량</th>
                        <th>체결량</th>
                        <th>평균 체결가</th>
                        <th>체결 금액</th>
                        <th>수수료</th>
                        <th>총체결</th>
                    </tr>
                </thead>
                <tbody id="userorder_container">
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="ui segment" style="width:100%">
            <h2>Calculator</h2>
            <div class="ui form" id="calc_container">
                <div class="field">
                    <label>주문 방식</label>
                    <select id="calc_ordertype" class="ui dropdown">
                        <option>Maker</option>
                        <option>Taker</option>
                    </select>
                </div>
                <div class="field">
                    <label>주문량</label>
                    <input type="number" id="calc_order_amount">
                </div>
                <div class="field">
                    <label>주문가</label>
                    <input type="number" id="calc_order_price">
                </div>
                <div class="field">
                    <label>판매가</label>
                    <input type="number" id="calc_sell_price">
                </div>
                <div class="ui divider"></div>
                <div id="calc_fee"></div>
            </div>
            <div id="calc_outcome">손이익 : 0</div>
        </div>
    </div>
</div>
<div class="ui message">
    <p>Created by <a href="https://antoniomin.github.io">Antonio Min</a>(gvvvv1123@gmail.com)</p>
</div>