import csv
from os.path import exists as file_exists

if file_exists('../GothamCSV.csv'):
    filevar = open('../GothamCSV.csv', 'r')
    reader = csv.reader(filevar, delimiter=',', quotechar='|')
    header = True
    for row in reader:
        if header:
            print ("Villian", "Name", "Crimes", "Henchmen")
        else:
            villian = row[1]
            name = row[2] + " " + row[3]
            crimes = row[6]
            henchmen = row[7]
            print ("{w} {x} {y} {z}".format(w=villian, x=name, y=crimes, z=henchmen))
        header = False
    filevar.close()