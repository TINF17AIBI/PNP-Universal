﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PnP_Universal.Models;

namespace PnP_Universal.Controllers
{
    [Produces("application/json")]
    [Route("api/Adventures")]
    public class AdventuresController : Controller
    {
        private readonly PnPContext _context;

        public AdventuresController(PnPContext context)
        {
            _context = context;
        }

        // GET: api/Adventures
        [HttpGet]
        public IEnumerable<Adventures> GetAdventures()
        {
            return _context.Adventures;
        }

        // GET: api/Adventures/5
        [HttpGet("{id}")]
        public async Task<IActionResult> GetAdventures([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var adventures = await _context.Adventures.SingleOrDefaultAsync(m => m.Id == id);

            if (adventures == null)
            {
                return NotFound();
            }

            return Ok(adventures);
        }

        // PUT: api/Adventures/5
        [HttpPut("{id}")]
        public async Task<IActionResult> PutAdventures([FromRoute] int id, [FromBody] Adventures adventures)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != adventures.Id)
            {
                return BadRequest();
            }

            _context.Entry(adventures).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!AdventuresExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/Adventures
        [HttpPost]
        public async Task<IActionResult> PostAdventures([FromBody] Adventures adventures)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            _context.Adventures.Add(adventures);
            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateException)
            {
                if (AdventuresExists(adventures.Id))
                {
                    return new StatusCodeResult(StatusCodes.Status409Conflict);
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtAction("GetAdventures", new { id = adventures.Id }, adventures);
        }

        // DELETE: api/Adventures/5
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteAdventures([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var adventures = await _context.Adventures.SingleOrDefaultAsync(m => m.Id == id);
            if (adventures == null)
            {
                return NotFound();
            }

            _context.Adventures.Remove(adventures);
            await _context.SaveChangesAsync();

            return Ok(adventures);
        }

        private bool AdventuresExists(int id)
        {
            return _context.Adventures.Any(e => e.Id == id);
        }
    }
}