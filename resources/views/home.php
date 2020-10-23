<div id="page-wrap">
    <h1>BNG RESTAPI</h1>
    <p>Aşağıdaki işlemleri desteklemektedir.</p>
    <dl class="faq">
        <dt>Stok Add</dt>
        <dd>
            <a target="_blank" class="hvr-underline-from-center" href="<?php echo URL; ?>/api/v1/stocks">POST <?php echo URL; ?>/api/v1/stocks"</a><br />
            <p>
                Required Parameters<br />
                <span style="color:#254CE0; text-decoration:none">{product_id} : string [zorunlu]</span><br />
                <span style="color:#254CE0; text-decoration:none">{name} : string [zorunlu]</span><br />
                <span style="color:#254CE0; text-decoration:none">{stock} : int [zorunlu]</span><br />
            </p>
        </dd>
        <dt>Stok List</dt>
        <dd>
            <a target="_blank" class="hvr-underline-from-center" href="<?php echo URL; ?>/api/v1/stocks">GET <?php echo URL; ?>/api/v1/stocks"</a><br />
            <p>
                No Parameters<br />
            </p>
        </dd>
    </dl>
</div>