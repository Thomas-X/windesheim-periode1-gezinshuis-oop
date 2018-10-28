import React from 'react';

const Select = ({name, values, value_accessor, title_accessor, onChange, label, disabled}) => {
	return (
			<>
				<label>{label}</label>
				<select name={name} className={'form-control'} onChange={onChange} disabled={disabled}>
					{values.map((val, idx) => (
							<option value={val[value_accessor]} key={idx}>
								{
									typeof title_accessor !== 'function'
											? val[title_accessor]
											: title_accessor(val)
								}
							</option>
					))}
				</select>
				<br/>
			</>
	);
};

export default Select;