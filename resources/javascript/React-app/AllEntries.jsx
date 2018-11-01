import React from 'react';
import FilterableInput from "./FilterableInput";
import Card from "./Card";

const AllEntries = () => {
	const data = JSDATA.items;
	const {baseUri, title, subtitle, newItemName, titleKey, secondTitleKey} = JSDATA;
	console.log(location.pathname.includes("careforschemas") !== -1);
	const determineField = (val, idx) => {
        return (
            <li className="list-group-item" key={idx}>
                <div className="row">
                    <div
                        className="col-sm-6 flexCenter">{titleKey && secondTitleKey ? (`${val[titleKey]} ${val[secondTitleKey]}`) : val[titleKey]}
                    </div>
                    <div className="col-sm-6 buttongrid">
                        <a href={`${baseUri}?id=${val.id}&type=update_get`}
                           className="btn btn-success flex1" role="button">
                            <i className="fas fa-sync margin-2"></i>
                            &thinsp;Update
                        </a>
                        <form action={`${baseUri}?id=${val.id}&type=delete_post`} method="post">
                            <button type="submit"
                                    className="btn btn-danger" role="button"
                                    style={{width: '100%'}}>
                                <i className="fas fa-trash margin-2"></i>
                                &thinsp;Remove
                            </button>
                        </form>
                        {location.pathname.includes("careforschemas") !== -1 ? (<button type="button"
                                                                                       className="btn btn-info" role="button"
                                                                                       style={{width: '100%'}}>
                            <i className="fas fa-download margin-2"></i>
                            &thinsp;Download
                        </button>) : null}
                    </div>
                </div>
            </li>
        );
	}
	return (
			<div className={'container'}>
				<Card title={`${newItemName}`}><a href={`${baseUri}?type=create_get`}
				                                  className="btn btn-success flex1" role="button">
					<i className="fas fa-plus margin-2"></i>
					&thinsp;voeg een nieuwe {newItemName} toe
				</a>
				</Card>
				<FilterableInput
						data={data}
						accessor={''}
						title={'alle datasets'}
						subtitle={`hieronder kan je makkelijk filteren om de correcte ${newItemName} te vinden`}
						determineField={(...args) => determineField(...args)}
						filter={(search, val) => {
							if (!!titleKey && !!secondTitleKey) {
								return (val[titleKey] + val[secondTitleKey]).indexOf(search) !== -1;
							} else {
								return val[titleKey].indexOf(search) !== -1
							}
						}}
				/>
			</div>
	);
};

export default AllEntries;