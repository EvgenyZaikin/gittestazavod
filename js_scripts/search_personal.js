document.addEventListener("DOMContentLoaded", function(){
	var search_button = document.getElementById('button_search');
	
	search_button.addEventListener("click", function(){
		var text_search = document.getElementById('input_search').value;
		var male_search = document.getElementById('input_checkbox_male').checked;
		var female_search = document.getElementById('input_checkbox_female').checked;
		var from_age_search = document.getElementById('input_from_age').value;
		var before_age_search = document.getElementById('input_before_age').value;
		var table_personal = document.getElementById('personal').getElementsByTagName('table')[0];
		var pagination = document.getElementById('pagination');
		
		pagination.innerHTML = '';
		table_personal.innerHTML = '<tr id="tr_values">' +
										'<td class="td_id"><p>№ id</p></td>' +
										'<td class="td_photo"><p>Фото</p></td>' +
										'<td class="td_fio"><p>ФИО</p></td>' +
										'<td class="td_age"><p>Возраст</p></td>' +
										'<td class="td_sex"><p>Пол</p></td>' +
										'<td class="td_action"><p>Действие</p></td>' +
									'</tr>';
		
		var xhr = new XMLHttpRequest();
		xhr.open('post', 'php_include/search_personal.php', true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
		xhr.onreadystatechange = function(){
			if(this.readyState == 4){
				if(this.status == 200){
					/* Выводим данные из базы данных */
					var massive_personal = JSON.parse(this.responseText);
					for(var i = 0; i < massive_personal.length; i++){
						var sex = '';
						var pag = '';
						if(massive_personal[i]["sex"] == 'Мужской') sex = 'male';
						else sex = 'female';
						var current_personal =  '<td class="td_id"><p>' + massive_personal[i]["id"] + '</p></td>' + 
												'<td class="td_photo"><p><img class="small_photo" src="photo/' + massive_personal[i]["photo"] + '" alt="photo" /></p></td>' + 
												'<td class="td_fio"><p>' + massive_personal[i]["name"] + ' ' + massive_personal[i]["surname"] + ' ' + massive_personal[i]["patronymic"] + '</p></td>' + 
												'<td class="td_age"><p>' + massive_personal[i]["age"] + ' лет</p></td>' + 
												'<td class="td_sex"><p class="' + sex + '">' + massive_personal[i]["sex"] + '</p></td>' + 
												'<td class="td_sex"><p><a href="current_personal.php?id=' + massive_personal[i]["id"] + '">Ред.</a> / <a class="delete_personal" data-id="' + massive_personal[i]['id'] + '" >Удалить</a></p></td>';
						var wrap = document.createElement('tr');
						if(i < 5) pag = 'pag_show';
						else pag = 'pag_hide';
						wrap.classList.add('current_personal');
						wrap.classList.add(pag);
						wrap.innerHTML = current_personal;
						table_personal.appendChild(wrap);
					}
					/* Создаём пагинацию */
					var rows = document.getElementsByClassName('current_personal');
					var pages = Math.floor(rows.length / 5) + 1;
					var pag_row = document.getElementById('pagination');
					for(var i = 0; i < pages; i++){
						var pag_link = document.createElement('p');
						pag_link.innerHTML = i + 1;
						pag_link.classList.add('pag_link');
						pag_link.setAttribute('data-id', i + 1);
						pag_row.appendChild(pag_link);
						pag_link.addEventListener("click", function(){
							var id = this.getAttribute('data-id');
							for(var j = 0; j < rows.length; j++){
								if(j >= (id - 1) * 5 && j < id * 5){
									rows[j].classList.remove('pag_hide');
									rows[j].classList.add('pag_show');
								} else {
									rows[j].classList.remove('pag_show');
									rows[j].classList.add('pag_hide');
								}
							}
						});
					}
					
					/* Удаление сотрудника */
					var delete_links = document.getElementsByClassName('delete_personal');
					for(var k = 0; k < delete_links.length; k++){
						delete_links[k].addEventListener("click", function(){
							var do_you_want_delete = confirm("Вы действительно хотите удалить этого сотрудника?");
							if(do_you_want_delete == true){
								var id_delete_links = this.getAttribute('data-id');
								var delete_xhr = new XMLHttpRequest();
								delete_xhr.open('post', 'php_include/delete_personal.php', true);
								delete_xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
								delete_xhr.onreadystatechange = function(){
									if(this.readyState == 4){
										if(this.status == 200){
											document.location.href = 'index.php';
										}
									}
								}	
								var delete_data = 'delete_id=' + id_delete_links;
								delete_xhr.send(delete_data);
							}
						});
					}
				}
			}
		}
		var data = 'text=' + encodeURIComponent(text_search) + '&male=' + encodeURIComponent(male_search)
				 + '&female=' + encodeURIComponent(female_search) + '&from_age=' + encodeURIComponent(from_age_search)
				 + '&before_age=' + encodeURIComponent(before_age_search);
		xhr.send(data);
	});
});