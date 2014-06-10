PROJECT=pifacedigital
SOURCES=src/pifacedigital.c
LIBRARY=static
INCPATHS=../libmcp23s17/src/
LIBPATHS=../libmcp23s17/
LDFLAGS=
CFLAGS=-c -Wall
CC=gcc

# ------------ MAGIC BEGINS HERE -------------

# Automatic generation of some important lists
OBJECTS=$(SOURCES:.c=.o)
INCFLAGS=$(foreach TMP,$(INCPATHS),-I$(TMP))
LIBFLAGS=$(foreach TMP,$(LIBPATHS),-L$(TMP))

# Set up the output file names for the different output types
ifeq "$(LIBRARY)" "shared"
    BINARY=lib$(PROJECT).so
    LDFLAGS += -shared
else ifeq "$(LIBRARY)" "static"
    BINARY=lib$(PROJECT).a
else
    BINARY=$(PROJECT)
endif

all: $(SOURCES) $(BINARY)

$(BINARY): $(OBJECTS)
    # Link the object files, or archive into a static library
    ifeq "$(LIBRARY)" "static"
	ar rcs $(BINARY) $(OBJECTS)
    else
	$(CC) $(LIBFLAGS) $(OBJECTS) $(LDFLAGS) -o $@
    endif

.c.o:
	$(CC) $(INCFLAGS) $(CFLAGS) -fPIC $< -o $@

distclean: clean
	rm -f $(BINARY)

test: test.c
	gcc -o test test.c -Isrc/ -L. -lpifacedigital -L../libmcp23s17/ -lmcp23s17

moteur: moteur.c
	gcc -o moteur moteur.c -Isrc/ -L. -lpifacedigital -L../libmcp23s17/ -lmcp23s17

moteur2: moteur2.c lectureEcriture
	gcc -o moteur2 moteur2.c lectureEcriture.o -Isrc/ -L. -lpifacedigital -L../libmcp23s17/ -lmcp23s17

lectureEcriture: lectureEcriture.c
	gcc -c lectureEcriture.c -o lectureEcriture.o

example: example.c
	gcc -o example example.c -Isrc/ -L. -lpifacedigital -L../libmcp23s17/ -lmcp23s17

pifacedigital: util/pifacedigital-cmd.c
	gcc -o pifacedigital util/pifacedigital-cmd.c -Isrc/ -I../libmcp23s17/src/ -L. -lpifacedigital -L../libmcp23s17/ -lmcp23s17

clean:
	rm -f $(OBJECTS)