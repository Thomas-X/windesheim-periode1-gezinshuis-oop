import React from 'react';

const Card = (props) => {
	return (
			<div className="card">
				<div className="card-body">
					{props.title && <h5 className={'card-title'}>{props.title}</h5>}
					{props.children}
				</div>
			</div>
	);
}

export default Card;