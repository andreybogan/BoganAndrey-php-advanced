'use strict'

$(function () {
  // Изменяем статус заказа.
  $('.cancelled').on('click', 'button', function () {
    let id_order = $(this).parent('li').data('id_order')
    $.ajax({
      url: '/order/changestatus',
      type: 'post',
      data: {
        id_order: id_order
      },
      success: (result) => {
        result = JSON.parse(result);
        console.log(result);
        if (result.success === 'ok') {
          $(this).parent('li').find('.status').html(result.message)
          $(this).parent('li').find('button').remove()
        }
      }
    })
  })

  // Изменяем видимость товара в каталоге.
  $('.editHide').on('click', function () {
    let id_prod = $(this).data('id_prod')
    let hide = ''
    if ($(this).html() === 'Скрыть') {
      hide = 'see'
    } else {
      hide = 'hide'
    }
    $.ajax({
      url: '/admin/changehide',
      type: 'post',
      data: {
        id_prod: id_prod,
        hide: hide
      },
      success: (result) => {
        result = JSON.parse(result)
        if (result.success === 'ok') {
          $(this).html(result.message)
        }
      }
    })
  })
})