from flask import Flask, jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_marshmallow import Marshmallow
from math import sin, cos, sqrt, atan2, radians
import os, re
import geopy.distance
import optparse

app = Flask(__name__)

@app.route('/api/distance/<from_place>/<to_place>', methods=['GET'])
def get_distance(from_place, to_place):

    match1 = re.search(';', from_place)
    match2 = re.search(';', to_place)
    if not match1 or not match2:
        return jsonify({
        'error': 'Lat lng not valid'
        })

    from_latLng = from_place.split(';')
    to_latLng = to_place.split(';')
    lat1 = float(from_latLng[0])
    lon1 = float(from_latLng[1])
    lat2 = float(to_latLng[0])
    lon2 = float(to_latLng[1])

    coords_1 = (lat1, lon1)
    coords_2 = (lat2, lon2)

    distance = geopy.distance.vincenty(coords_1, coords_2).km

    return jsonify(
        {
            'from_place' : from_place,
            'to_place' : to_place,
            'distance' : distance
        }
    )

if __name__ == '__main__':
    app.run(host='0.0.0.0', port='8088', debug=False)