by https://github.com/Alecaddd/awps


Примечания: 
   - Блоки кода, особенно которые не меняют кардинально структуру дефолтных файлов,    помечены как
      // WV
      <my-code>
      // WV 

Плагины:

TI WooCommerce Wishlist
   - Расширен до работы в offcanvas.

ProWC_Empty_Cart_Button_Core
   - Редирект после очистки корзины обновлен с помощью прямого изменения кода плагина
   - Также обновлён текст кнопки


имнования классов, щаблонов и т.п. производится по схеме:
 - префикс 'wv' добавляется к наименованиям чего-либо, чего не существует в WP и плагинах,
    например, в структуре шаблонов WC нет папки wv-universal-products - она создана.
    то же самое с файлами, которые созданы, условно, с нуля 


Все меню имеют общие классы, вдобавок к дефолтным, таким как menu-item, добавляется БЭМ-структура, состоящая из таких, как menu-main__item
Реализованы такие меню как:
   - footer_contacts,
   # - header_contacts,
   - categories_footer,
   - categories_header
и другие.

Их индивидуальные селекторы классов находятся в templates/wv-locations

ВОЗМОЖНЫЕ ФИКСЫ
   - инициализация таких bootstrap структур как Collapse'es - иниициировать их из JS - только на соответвующих breakpoint's


ПЛАГИНЫ:
   /Side Cart WooCommerce/
      Изменение расположения корзины производится перемещением в первую очередь
      .xoo-wsc-container, который вместе с другими свойствами response аозвращается по запросу POST
         http://localhost/?wc-ajax=xoo_wsc_add_to_cart

         response: {
         cart_hash: "e8d61928c5f51727a2ca55b3eb9b010c",
         fragments: {
            "div.widget_shopping_cart_content",
            "div.xoo-wsc-container": "",
            "div.xoo-wsc-slider": "",
            },
         }


/*******/
Временные заметки:
 BS 
  - @media (min-width: 1400px) {}

response.fragments["div.widget_shopping_cart_content"]