import React, {Component} from 'react';
import Card from "./Card";

class FilterableInput extends Component {
	state = {
		search: '',
	}

	onSearchChange = (e) => {
		this.setState({
			search: e.target.value,
		})
	};

	render() {
		const { data, accessor, title, subtitle, determineField, filter} = this.props;
		const { search } = this.state;
		const ownFilter = (val) => val[accessor].indexOf(search) !== -1
		let _filter;
		if (filter) {
			_filter = (...args) => {
				return filter(search, ...args);
			}
		}
		const filteredLinks = data.filter(_filter || ownFilter);

		return (
				<Card>
					<h5 id={'links'} className="card-title">{title}</h5>
					<p className="card-text">{subtitle}</p>
					<div className="input-group" style={{marginBottom: '1.5rem'}}>
						<div className="input-group-prepend">
									<span className={'input-group-text'}>
										<i className="fas fa-search"></i>
									</span>
						</div>
						<input placeholder={'zoek..'} value={search} className="form-control"
						       onChange={(e) => {
							       this.onSearchChange(e);
						       }}/>
					</div>
					{filteredLinks.map((...args) => determineField(...args))}
				</Card>
		);
	}
}

export default FilterableInput;