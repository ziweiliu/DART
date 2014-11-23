<script id="overlay-template" type="template">
    <div id="display-preview">
        <img id="preview-main" src="../objects/{{images.[0].image_filepath}}" />
        <div id="display-thumbnails">
            {{#each images}}
            <div class="thumbnail-icon">
                <img class="icon-img" src="../objects/{{this.image_filepath}}"/>
                <div class="icon-state"></div>
            </div>
            {{/each}}
        </div>
    </div><!-- end div#display-preview -->

    <div id="display-info">
        <div id="info-name">{{name}}</div>
        <div id="info-collection">from the <a class="standout hover" href="#collection">{{collection_name}}</a> collection</div>
        <div id="info-designer">designed by <a class="standout hover" href="#designer">{{designer_first_name}} {{designer_last_name}}</a></div>
        <div id="info-category">
            <a class="standout hover" href="#category">{{category}}</a> - <a class="standout hover" href="#subcategory">{{subcategory}}</a>
        </div>
        <div id="info-description">{{description}}</div>
    </div><!-- end div#display-info -->

    <div id="display-form">
        <form method="get">

            <div id="form-size" class="form-grp">
                <div class="form-label">What size would you like your object in?</div>

                {{#each size_array}}
                <label class="radio-label">
                    <input class="radio-input" type="radio" name="size" value="{{this}}"/>
                    <span>{{this}}</span>
                </label>
                {{/each}}

                <div class="clear"></div>
            </div>

            <div id="form-material" class="form-grp">
                <div class="form-label">What material would you like your object to be made from?</div>

                {{#each material_array}}
                <label class="radio-label">
                    <input class="radio-input" type="radio" name="material-id" value="{{mat_id}}"/>
                    <span>{{mat_name}}</span>
                </label>
                {{/each}}

                <div class="clear"></div>
            </div>

            {{#if accessory_array}}
            <div id="form-accesory" class="form-grp">
                <div class="form-label">Would you like to add an accessory?</div>
                <select class="select-input" name="accessory-id">
                    <option value="none">none</option>
                    <option value="1">10in silver necklace</option>
                    <option value="2">14in silver necklace</option>
                    <option value="3">16in leather necklace</option>
                </select>
            </div>
            {{/if}}

            <div id="form-price" class="form-grp bb-1 bt-1"><span id="price-update"></span></div>

            {{#ifEqual type 1}}
            <div id="design-btn">
                <input type="hidden" name="detail_id" value=""/>
                <button type="submit" formmethod="GET" formaction="../purchase/index.php" onclick="">BUY</button>
                <button type="submit" formmethod="GET" formaction="../enable/request/index.php">DESIGN</button>
                <div id="form-info">BUY ORDERS OBJECT AS IS.</div>
            </div>
            {{else}}
            <div id="unique-btn">
                <input type="hidden" name="detail_id" value=""/>
                <button type="submit" formmethod="GET" formaction="../purchase/index.php">BUY</button>
            </div>
            {{/ifEqual}}
        </form>
    </div><!-- div#display-form -->

    <div class="clear"></div>
</script>