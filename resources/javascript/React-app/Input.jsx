import React from 'react';
import _ from 'lodash';

const Input = (props) => {
	return (
			<>
				<label>{props.label}</label>
				<input className={'form-control'} {..._.omit(props, ['label'])}/>
			</>
	);
};

export default Input;