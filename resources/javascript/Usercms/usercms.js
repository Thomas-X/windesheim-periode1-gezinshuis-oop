import $ from 'jquery';
import _ from 'lodash';

const profile_type = $('#profile_type_selector');
const initialValue = profile_type.val();

function determineSelectField(value) {

	function returnProfileSelect(data, title_accessor, label) {
		const html = `
		<div id="profile_selector_container">
			<br/>
			<div class="form-group">
				<label>${label}</label>
				<select class="form-control" name="profile_value">
					${data.map((val, idx) => `
							<option value="${val['profile_value_for_javascript_frontend']}">
								${val[title_accessor]}
							</option>
				`)}
				</select>
			</div>
		</div>
		`;
		return html;
	}
	const profile_selector_container = $('#profile_selector_container');
	if (!!profile_selector_container) {
		profile_selector_container.remove();
	}
	let html;
	switch (value) {
		case 'profiles_employees':
			html = returnProfileSelect(
					JSDATA['profiles']['profiles_employees']
							.map((val, idx) => ({
								profile_title_for_javascript_frontend: val.nickname,
								profile_value_for_javascript_frontend: val.id,
								..._.omit(val, ['nickname', 'id']),
							})),
					'profile_title_for_javascript_frontend',
					'welk medewerker profiel moet gekozen worden?'
			);
			break;
		case 'profiles_parents_caretakers':
			html = returnProfileSelect(
					JSDATA['profiles']['profiles_parents_caretakers']
							.map((val, idx) => ({
								profile_title_for_javascript_frontend: val.nickname,
								profile_value_for_javascript_frontend: val.id,
								..._.omit(val, ['nickname', 'id']),
							})),
					'profile_title_for_javascript_frontend',
					'welk ouder profiel moet gekozen worden?'
			);
			break;
		case 'profiles_kids':
			html = returnProfileSelect(
					JSDATA['profiles']['profiles_kids']
							.map((val, idx) => ({
								profile_title_for_javascript_frontend: val.nickname,
								profile_value_for_javascript_frontend: val.id,
								..._.omit(val, ['nickname', 'id']),
							})),
					'profile_title_for_javascript_frontend',
					'welk kind profiel moet gekozen worden?'
			);
			break;
		case 'profiles_doctors':
			html = returnProfileSelect(
					JSDATA['profiles']['profiles_doctors']
							.map((val, idx) => ({
								profile_title_for_javascript_frontend: val.nickname,
								profile_value_for_javascript_frontend: val.id,
								..._.omit(val, ['nickname', 'id']),
							})),
					'profile_title_for_javascript_frontend',
					'welk behandelaar profiel moet gekozen worden?'
			);
			break;
		default:
			html = "<div></div>";
	}
	$(html).appendTo("#profile_container");
}

determineSelectField(initialValue);

$(document).on('change', '#profile_type_selector', function (e) {
	const val = this.options[e.target.selectedIndex].value;
	determineSelectField(val)
});