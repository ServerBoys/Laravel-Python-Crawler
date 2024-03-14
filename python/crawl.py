import requests
from bs4 import BeautifulSoup
import json

url = input()
response = requests.get(url.split(' ')[0])

my_urls = []
if response.status_code == 200:
    soup = BeautifulSoup(response.text, 'html.parser')
    for link in soup.find_all('a'):
        if link.get('href') == '#':
            continue
        my_urls.append({
            'href': link.get('href') if not link.get('href').startswith('/') else url.rstrip('/') + link.get('href'),
            'nofollow': link.get('rel') is not None and 'nofollow' in link.get('rel')}
        )
    print(json.dumps(my_urls, indent=4))
else:
    print('{"error": "Something went wrong"}')
