{if $related_products}
    <div class="related-products">
        <h3>Produits de la même catégorie</h3>
        {foreach from=$related_products item=product}
            <div class="related-product">
                <img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'medium_default')}" alt="{$product.name|escape:'html':'UTF-8'}">
                <h4><strong>{$product.name|escape:'html':'UTF-8'}</strong></h4>
                <p><strong>{$product.price|number_format:2|replace:'.':','} TTC</strong></p>
                <a href="{$link->getPageLink('cart', true, null, "add={$product.id_product}")}" class="add-to-cart">Ajouter au panier</a>
            </div>
        {/foreach}
    </div>
{else}
    <h3>Produits de la même catégorie</h3>
    <p>Aucun produit trouvé.</p>
{/if}